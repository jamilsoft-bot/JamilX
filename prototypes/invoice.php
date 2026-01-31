<?php

const INVOICE_TABLE_INVOICES = 'invoices';
const INVOICE_TABLE_ITEMS = 'invoice_items';
const INVOICE_TABLE_CLIENTS = 'invoice_clients';
const INVOICE_TABLE_SETTINGS = 'invoice_settings';

function invoice_db()
{
    global $JX_db;
    return $JX_db;
}

function invoice_escape($value)
{
    return invoice_db()->real_escape_string((string) $value);
}

function invoice_html($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function invoice_slug($value)
{
    $value = strtolower(trim((string) $value));
    $value = preg_replace('/[^a-z0-9\s-]/', '', $value);
    $value = preg_replace('/[\s-]+/', '-', $value);
    return trim($value, '-');
}

function invoice_currency($value)
{
    return number_format((float) $value, 2, '.', ',');
}

function invoice_require_login($resume = 'invoice')
{
    if (!isset($_SESSION['uid'])) {
        Redirect('login&resume=' . $resume);
        return false;
    }
    return true;
}

function invoice_is_admin()
{
    global $Me;
    $role = strtolower((string) $Me->role());
    return $role === 'admin';
}

function invoice_can_manage(array $invoice)
{
    global $Me;
    if (invoice_is_admin()) {
        return true;
    }
    $ownerId = (int) ($invoice['created_by'] ?? 0);
    $userId = (int) ($Me->id() ?? 0);
    return $ownerId > 0 && $ownerId === $userId;
}

function invoice_csrf_token()
{
    if (!isset($_SESSION['invoice_csrf'])) {
        $_SESSION['invoice_csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['invoice_csrf'];
}

function invoice_validate_csrf($token)
{
    return isset($_SESSION['invoice_csrf']) && hash_equals($_SESSION['invoice_csrf'], (string) $token);
}

function invoice_get_settings()
{
    $sql = "SELECT * FROM `" . INVOICE_TABLE_SETTINGS . "` ORDER BY id ASC LIMIT 1";
    $result = invoice_db()->query($sql);
    $row = $result ? $result->fetch_assoc() : null;
    if (!$row) {
        invoice_db()->query("INSERT INTO `" . INVOICE_TABLE_SETTINGS . "` (`prefix`, `next_number`, `created_at`, `updated_at`) VALUES ('INV-', 1, NOW(), NOW())");
        $result = invoice_db()->query($sql);
        $row = $result ? $result->fetch_assoc() : null;
    }
    return $row;
}

function invoice_update_settings($prefix, $nextNumber)
{
    $prefix = invoice_escape($prefix);
    $nextNumber = max(1, (int) $nextNumber);
    $sql = "UPDATE `" . INVOICE_TABLE_SETTINGS . "` SET `prefix` = '$prefix', `next_number` = $nextNumber, `updated_at` = NOW()";
    return invoice_db()->query($sql);
}

function invoice_next_number()
{
    $db = invoice_db();
    $db->begin_transaction();
    try {
        $settings = invoice_get_settings();
        $prefix = $settings['prefix'] ?? 'INV-';
        $nextNumber = (int) ($settings['next_number'] ?? 1);
        $invoiceNumber = $prefix . str_pad((string) $nextNumber, 5, '0', STR_PAD_LEFT);
        $nextNumber++;
        $safePrefix = invoice_escape($prefix);
        $db->query("UPDATE `" . INVOICE_TABLE_SETTINGS . "` SET `next_number` = $nextNumber, `updated_at` = NOW(), `prefix` = '$safePrefix'");
        $db->commit();
        return $invoiceNumber;
    } catch (Throwable $e) {
        $db->rollback();
        throw $e;
    }
}

function invoice_client_list()
{
    $sql = "SELECT * FROM `" . INVOICE_TABLE_CLIENTS . "` WHERE `deleted_at` IS NULL ORDER BY name ASC";
    $result = invoice_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function invoice_get_client($id)
{
    $id = (int) $id;
    $sql = "SELECT * FROM `" . INVOICE_TABLE_CLIENTS . "` WHERE id = $id LIMIT 1";
    $result = invoice_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function invoice_upsert_client($id, array $data)
{
    $name = invoice_escape($data['name'] ?? '');
    $email = invoice_escape($data['email'] ?? '');
    $phone = invoice_escape($data['phone'] ?? '');
    $address = invoice_escape($data['address'] ?? '');
    $company = invoice_escape($data['company'] ?? '');
    $userId = (int) ($data['user_id'] ?? 0);

    if ($id) {
        $id = (int) $id;
        $sql = "UPDATE `" . INVOICE_TABLE_CLIENTS . "` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `address` = '$address', `company` = '$company', `user_id` = " . ($userId ?: 'NULL') . ", `updated_at` = NOW() WHERE id = $id";
        return invoice_db()->query($sql);
    }

    $sql = "INSERT INTO `" . INVOICE_TABLE_CLIENTS . "` (`name`, `email`, `phone`, `address`, `company`, `user_id`, `created_at`, `updated_at`)
            VALUES ('$name', '$email', '$phone', '$address', '$company', " . ($userId ?: 'NULL') . ", NOW(), NOW())";
    return invoice_db()->query($sql);
}

function invoice_delete_client($id)
{
    $id = (int) $id;
    $sql = "UPDATE `" . INVOICE_TABLE_CLIENTS . "` SET `deleted_at` = NOW() WHERE id = $id";
    return invoice_db()->query($sql);
}

function invoice_calculate_totals(array $items)
{
    $subtotal = 0.0;
    $taxTotal = 0.0;
    $discountTotal = 0.0;
    $lineItems = [];

    foreach ($items as $item) {
        $qty = max(0, (float) $item['quantity']);
        $unit = max(0, (float) $item['unit_price']);
        $discount = max(0, (float) $item['discount']);
        $tax = max(0, (float) $item['tax']);
        $line = ($qty * $unit) - $discount + $tax;
        $subtotal += $qty * $unit;
        $discountTotal += $discount;
        $taxTotal += $tax;
        $lineItems[] = [
            'description' => $item['description'],
            'quantity' => $qty,
            'unit_price' => $unit,
            'discount' => $discount,
            'tax' => $tax,
            'line_total' => $line,
        ];
    }

    $total = $subtotal - $discountTotal + $taxTotal;
    return [
        'subtotal' => $subtotal,
        'discount_total' => $discountTotal,
        'tax_total' => $taxTotal,
        'total' => $total,
        'items' => $lineItems,
    ];
}

function invoice_fetch_invoices($page, $perPage, $filters = [])
{
    global $Me;
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $offset = ($page - 1) * $perPage;
    $conditions = ["i.deleted_at IS NULL"];

    if (!invoice_is_admin()) {
        $userId = (int) ($Me->id() ?? 0);
        $conditions[] = "i.created_by = $userId";
    }

    if (!empty($filters['status'])) {
        $status = invoice_escape($filters['status']);
        $conditions[] = "i.status = '$status'";
    }

    if (!empty($filters['search'])) {
        $search = invoice_escape($filters['search']);
        $conditions[] = "(i.invoice_number LIKE '%$search%' OR c.name LIKE '%$search%')";
    }

    $where = implode(' AND ', $conditions);
    $sql = "SELECT i.*, c.name AS client_name, c.email AS client_email
            FROM `" . INVOICE_TABLE_INVOICES . "` i
            LEFT JOIN `" . INVOICE_TABLE_CLIENTS . "` c ON i.client_id = c.id
            WHERE $where
            ORDER BY i.created_at DESC
            LIMIT $perPage OFFSET $offset";
    $result = invoice_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function invoice_count_invoices($filters = [])
{
    global $Me;
    $conditions = ["deleted_at IS NULL"];
    if (!invoice_is_admin()) {
        $userId = (int) ($Me->id() ?? 0);
        $conditions[] = "created_by = $userId";
    }
    if (!empty($filters['status'])) {
        $status = invoice_escape($filters['status']);
        $conditions[] = "status = '$status'";
    }
    if (!empty($filters['search'])) {
        $search = invoice_escape($filters['search']);
        $conditions[] = "(invoice_number LIKE '%$search%')";
    }
    $where = implode(' AND ', $conditions);
    $sql = "SELECT COUNT(*) AS total FROM `" . INVOICE_TABLE_INVOICES . "` WHERE $where";
    $result = invoice_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function invoice_get_invoice($id)
{
    $id = (int) $id;
    $sql = "SELECT i.*, c.name AS client_name, c.email AS client_email, c.phone AS client_phone, c.address AS client_address, c.company AS client_company
            FROM `" . INVOICE_TABLE_INVOICES . "` i
            LEFT JOIN `" . INVOICE_TABLE_CLIENTS . "` c ON i.client_id = c.id
            WHERE i.id = $id LIMIT 1";
    $result = invoice_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function invoice_get_items($invoiceId)
{
    $invoiceId = (int) $invoiceId;
    $sql = "SELECT * FROM `" . INVOICE_TABLE_ITEMS . "` WHERE invoice_id = $invoiceId ORDER BY id ASC";
    $result = invoice_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function invoice_insert_invoice(array $data, array $items)
{
    global $Me;
    $db = invoice_db();
    $db->begin_transaction();
    try {
        $invoiceNumber = invoice_next_number();
        $clientId = (int) $data['client_id'];
        $status = invoice_escape($data['status']);
        $issueDate = invoice_escape($data['issue_date']);
        $dueDate = $data['due_date'] ? "'" . invoice_escape($data['due_date']) . "'" : 'NULL';
        $notes = invoice_escape($data['notes']);
        $totals = invoice_calculate_totals($items);

        $sql = "INSERT INTO `" . INVOICE_TABLE_INVOICES . "`
                (`client_id`, `invoice_number`, `status`, `issue_date`, `due_date`, `subtotal`, `tax_total`, `discount_total`, `total`, `amount_paid`, `balance_due`, `notes`, `created_by`, `created_at`, `updated_at`)
                VALUES ($clientId, '" . invoice_escape($invoiceNumber) . "', '$status', '$issueDate', $dueDate, " .
                (float) $totals['subtotal'] . ", " . (float) $totals['tax_total'] . ", " . (float) $totals['discount_total'] . ", " .
                (float) $totals['total'] . ", 0, " . (float) $totals['total'] . ", '$notes', " . (int) ($Me->id() ?? 0) . ", NOW(), NOW())";
        if (!$db->query($sql)) {
            throw new RuntimeException($db->error);
        }
        $invoiceId = $db->insert_id;

        foreach ($totals['items'] as $item) {
            $description = invoice_escape($item['description']);
            $qty = (float) $item['quantity'];
            $unit = (float) $item['unit_price'];
            $discount = (float) $item['discount'];
            $tax = (float) $item['tax'];
            $lineTotal = (float) $item['line_total'];
            $itemSql = "INSERT INTO `" . INVOICE_TABLE_ITEMS . "`
                        (`invoice_id`, `description`, `quantity`, `unit_price`, `discount`, `tax`, `line_total`, `created_at`)
                        VALUES ($invoiceId, '$description', $qty, $unit, $discount, $tax, $lineTotal, NOW())";
            if (!$db->query($itemSql)) {
                throw new RuntimeException($db->error);
            }
        }

        $db->commit();
        return $invoiceId;
    } catch (Throwable $e) {
        $db->rollback();
        return null;
    }
}

function invoice_update_invoice($id, array $data, array $items)
{
    $db = invoice_db();
    $db->begin_transaction();
    try {
        $id = (int) $id;
        $clientId = (int) $data['client_id'];
        $status = invoice_escape($data['status']);
        $issueDate = invoice_escape($data['issue_date']);
        $dueDate = $data['due_date'] ? "'" . invoice_escape($data['due_date']) . "'" : 'NULL';
        $notes = invoice_escape($data['notes']);
        $totals = invoice_calculate_totals($items);

        $sql = "UPDATE `" . INVOICE_TABLE_INVOICES . "` SET
                `client_id` = $clientId,
                `status` = '$status',
                `issue_date` = '$issueDate',
                `due_date` = $dueDate,
                `subtotal` = " . (float) $totals['subtotal'] . ",
                `tax_total` = " . (float) $totals['tax_total'] . ",
                `discount_total` = " . (float) $totals['discount_total'] . ",
                `total` = " . (float) $totals['total'] . ",
                `balance_due` = GREATEST(`total` - `amount_paid`, 0),
                `notes` = '$notes',
                `updated_at` = NOW()
                WHERE id = $id";
        if (!$db->query($sql)) {
            throw new RuntimeException($db->error);
        }

        $db->query("DELETE FROM `" . INVOICE_TABLE_ITEMS . "` WHERE invoice_id = $id");
        foreach ($totals['items'] as $item) {
            $description = invoice_escape($item['description']);
            $qty = (float) $item['quantity'];
            $unit = (float) $item['unit_price'];
            $discount = (float) $item['discount'];
            $tax = (float) $item['tax'];
            $lineTotal = (float) $item['line_total'];
            $itemSql = "INSERT INTO `" . INVOICE_TABLE_ITEMS . "`
                        (`invoice_id`, `description`, `quantity`, `unit_price`, `discount`, `tax`, `line_total`, `created_at`)
                        VALUES ($id, '$description', $qty, $unit, $discount, $tax, $lineTotal, NOW())";
            if (!$db->query($itemSql)) {
                throw new RuntimeException($db->error);
            }
        }
        $db->commit();
        return true;
    } catch (Throwable $e) {
        $db->rollback();
        return false;
    }
}

function invoice_soft_delete($id)
{
    $id = (int) $id;
    $sql = "UPDATE `" . INVOICE_TABLE_INVOICES . "` SET `deleted_at` = NOW() WHERE id = $id";
    return invoice_db()->query($sql);
}

function invoice_update_payment_totals($invoiceId)
{
    $invoiceId = (int) $invoiceId;
    $sql = "SELECT COALESCE(SUM(amount - refunded_amount), 0) AS paid FROM `payments` WHERE invoice_id = $invoiceId";
    $result = invoice_db()->query($sql);
    $paid = 0.0;
    if ($result && ($row = $result->fetch_assoc())) {
        $paid = (float) $row['paid'];
    }
    $invoice = invoice_get_invoice($invoiceId);
    if (!$invoice) {
        return false;
    }

    $balance = max(0, (float) $invoice['total'] - $paid);
    $status = $invoice['status'];
    if ($status !== 'Cancelled') {
        if ($balance <= 0.01) {
            $status = 'Paid';
        } elseif ($paid > 0) {
            $status = 'Partially Paid';
        } else {
            $status = 'Sent';
        }
        if ($balance > 0 && !empty($invoice['due_date']) && strtotime($invoice['due_date']) < time()) {
            $status = 'Overdue';
        }
    }

    $status = invoice_escape($status);
    $sql = "UPDATE `" . INVOICE_TABLE_INVOICES . "` SET `amount_paid` = $paid, `balance_due` = $balance, `status` = '$status', `updated_at` = NOW() WHERE id = $invoiceId";
    return invoice_db()->query($sql);
}

function invoice_send_email($invoice, $items, $message)
{
    if (!class_exists('Email')) {
        return ['success' => false, 'error' => 'Email service is not available.'];
    }
    $recipient = $invoice['client_email'] ?? '';
    if ($recipient === '') {
        return ['success' => false, 'error' => 'Client email address is missing.'];
    }
    $subject = 'Invoice ' . ($invoice['invoice_number'] ?? '');
    $html = '<p>' . invoice_html($message) . '</p>';
    $html .= '<p>Invoice Total: <strong>' . invoice_currency($invoice['total']) . '</strong></p>';
    $html .= '<p>Balance Due: <strong>' . invoice_currency($invoice['balance_due']) . '</strong></p>';
    $html .= '<p>View invoice: <a href="/invoice?action=view&id=' . (int) $invoice['id'] . '">Invoice link</a></p>';
    return Email::send($recipient, $subject, $html, []);
}

function invoice_parse_items_from_post($post)
{
    $items = [];
    $descriptions = $post['item_description'] ?? [];
    $quantities = $post['item_quantity'] ?? [];
    $unitPrices = $post['item_unit_price'] ?? [];
    $discounts = $post['item_discount'] ?? [];
    $taxes = $post['item_tax'] ?? [];

    foreach ($descriptions as $index => $description) {
        $desc = trim((string) $description);
        if ($desc === '') {
            continue;
        }
        $items[] = [
            'description' => $desc,
            'quantity' => $quantities[$index] ?? 0,
            'unit_price' => $unitPrices[$index] ?? 0,
            'discount' => $discounts[$index] ?? 0,
            'tax' => $taxes[$index] ?? 0,
        ];
    }

    return $items;
}
