<?php

const BILLING_TABLE_PAYMENTS = 'payments';

function billing_db()
{
    return invoice_db();
}

function billing_require_login($resume = 'billing')
{
    return invoice_require_login($resume);
}

function billing_is_admin()
{
    return invoice_is_admin();
}

function billing_html($value)
{
    return invoice_html($value);
}

function billing_escape($value)
{
    return invoice_escape($value);
}

function billing_csrf_token()
{
    if (!isset($_SESSION['billing_csrf'])) {
        $_SESSION['billing_csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['billing_csrf'];
}

function billing_validate_csrf($token)
{
    return isset($_SESSION['billing_csrf']) && hash_equals($_SESSION['billing_csrf'], (string) $token);
}

function billing_fetch_payments($page, $perPage, $filters = [])
{
    global $Me;
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $offset = ($page - 1) * $perPage;
    $conditions = ["1 = 1"];

    if (!billing_is_admin()) {
        $userId = (int) ($Me->id() ?? 0);
        $conditions[] = "p.created_by = $userId";
    }

    if (!empty($filters['invoice_id'])) {
        $invoiceId = (int) $filters['invoice_id'];
        $conditions[] = "p.invoice_id = $invoiceId";
    }

    $where = implode(' AND ', $conditions);
    $sql = "SELECT p.*, i.invoice_number, i.total, i.balance_due, c.name AS client_name
            FROM `" . BILLING_TABLE_PAYMENTS . "` p
            LEFT JOIN `" . INVOICE_TABLE_INVOICES . "` i ON p.invoice_id = i.id
            LEFT JOIN `" . INVOICE_TABLE_CLIENTS . "` c ON i.client_id = c.id
            WHERE $where
            ORDER BY p.created_at DESC
            LIMIT $perPage OFFSET $offset";
    $result = billing_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function billing_count_payments($filters = [])
{
    global $Me;
    $conditions = ["1 = 1"];
    if (!billing_is_admin()) {
        $userId = (int) ($Me->id() ?? 0);
        $conditions[] = "created_by = $userId";
    }
    if (!empty($filters['invoice_id'])) {
        $invoiceId = (int) $filters['invoice_id'];
        $conditions[] = "invoice_id = $invoiceId";
    }
    $where = implode(' AND ', $conditions);
    $sql = "SELECT COUNT(*) AS total FROM `" . BILLING_TABLE_PAYMENTS . "` WHERE $where";
    $result = billing_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function billing_record_payment($invoiceId, $amount, $method, $notes)
{
    global $Me;
    $db = billing_db();
    $db->begin_transaction();
    try {
        $invoiceId = (int) $invoiceId;
        $amount = max(0, (float) $amount);
        $method = billing_escape($method);
        $notes = billing_escape($notes);
        $createdBy = (int) ($Me->id() ?? 0);

        $sql = "INSERT INTO `" . BILLING_TABLE_PAYMENTS . "` (`invoice_id`, `amount`, `method`, `notes`, `refunded_amount`, `created_by`, `created_at`)
                VALUES ($invoiceId, $amount, '$method', '$notes', 0, $createdBy, NOW())";
        if (!$db->query($sql)) {
            throw new RuntimeException($db->error);
        }

        invoice_update_payment_totals($invoiceId);
        $db->commit();
        return true;
    } catch (Throwable $e) {
        $db->rollback();
        return false;
    }
}

function billing_refund_payment($paymentId, $refundAmount, $notes)
{
    $db = billing_db();
    $db->begin_transaction();
    try {
        $paymentId = (int) $paymentId;
        $refundAmount = max(0, (float) $refundAmount);
        $notes = billing_escape($notes);

        $payment = billing_get_payment($paymentId);
        if (!$payment) {
            throw new RuntimeException('Payment not found.');
        }
        $maxRefund = max(0, (float) $payment['amount'] - (float) $payment['refunded_amount']);
        if ($refundAmount > $maxRefund) {
            throw new RuntimeException('Refund exceeds payment balance.');
        }
        $newRefund = (float) $payment['refunded_amount'] + $refundAmount;
        $sql = "UPDATE `" . BILLING_TABLE_PAYMENTS . "` SET `refunded_amount` = $newRefund, `refund_notes` = '$notes', `refunded_at` = NOW() WHERE id = $paymentId";
        if (!$db->query($sql)) {
            throw new RuntimeException($db->error);
        }

        invoice_update_payment_totals((int) $payment['invoice_id']);
        $db->commit();
        return true;
    } catch (Throwable $e) {
        $db->rollback();
        return false;
    }
}

function billing_get_payment($id)
{
    $id = (int) $id;
    $sql = "SELECT * FROM `" . BILLING_TABLE_PAYMENTS . "` WHERE id = $id LIMIT 1";
    $result = billing_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function billing_dashboard_stats()
{
    global $Me;
    $conditions = ["i.deleted_at IS NULL"];
    if (!billing_is_admin()) {
        $userId = (int) ($Me->id() ?? 0);
        $conditions[] = "i.created_by = $userId";
    }
    $where = implode(' AND ', $conditions);
    $sql = "SELECT
                SUM(p.amount - p.refunded_amount) AS total_received,
                SUM(i.balance_due) AS total_outstanding,
                SUM(CASE WHEN i.status = 'Overdue' THEN 1 ELSE 0 END) AS overdue_count
            FROM `" . INVOICE_TABLE_INVOICES . "` i
            LEFT JOIN `" . BILLING_TABLE_PAYMENTS . "` p ON p.invoice_id = i.id
            WHERE $where";
    $result = billing_db()->query($sql);
    return $result ? $result->fetch_assoc() : ['total_received' => 0, 'total_outstanding' => 0, 'overdue_count' => 0];
}
