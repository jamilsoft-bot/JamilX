<?php

function invoice_index()
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    $page = max(1, (int) $Url->get('page'));
    $perPage = 10;
    $search = trim((string) $Url->get('q'));
    $status = $Url->get('status');
    $filters = [
        'search' => $search,
        'status' => $status,
    ];
    $invoices = invoice_fetch_invoices($page, $perPage, $filters);
    $total = invoice_count_invoices($filters);
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
    ];
    include 'containers/invoice/index.php';
}

function invoice_view($id)
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $items = invoice_get_items($invoice['id']);
    include 'containers/invoice/view.php';
}

function invoice_create($errors = [], $values = [])
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $clients = invoice_client_list();
    $csrf = invoice_csrf_token();
    include 'containers/invoice/form.php';
}

function invoice_store()
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    $errors = [];

    if (!invoice_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token. Please try again.';
    }

    $clientId = (int) $Url->post('client_id');
    $status = $Url->post('status') ?: 'Draft';
    $issueDate = trim((string) $Url->post('issue_date')) ?: date('Y-m-d');
    $dueDate = trim((string) $Url->post('due_date'));
    $notes = trim((string) $Url->post('notes'));
    $items = invoice_parse_items_from_post($_POST);

    if ($clientId <= 0) {
        $errors[] = 'Client is required.';
    }
    if (empty($items)) {
        $errors[] = 'At least one invoice item is required.';
    }

    $validStatuses = ['Draft', 'Sent', 'Partially Paid', 'Paid', 'Overdue', 'Cancelled'];
    if (!in_array($status, $validStatuses, true)) {
        $status = 'Draft';
    }

    if (!empty($errors)) {
        invoice_create($errors, $_POST);
        return;
    }

    $invoiceId = invoice_insert_invoice([
        'client_id' => $clientId,
        'status' => $status,
        'issue_date' => $issueDate,
        'due_date' => $dueDate,
        'notes' => $notes,
    ], $items);

    if (!$invoiceId) {
        $errors[] = 'Unable to save invoice.';
        invoice_create($errors, $_POST);
        return;
    }

    Redirect('invoice/view/' . $invoiceId);
}

function invoice_edit($id, $errors = [], $values = [])
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $items = invoice_get_items($invoice['id']);
    $clients = invoice_client_list();
    $csrf = invoice_csrf_token();
    include 'containers/invoice/form.php';
}

function invoice_update($id)
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }

    $errors = [];
    if (!invoice_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token. Please try again.';
    }

    $clientId = (int) $Url->post('client_id');
    $status = $Url->post('status') ?: $invoice['status'];
    $issueDate = trim((string) $Url->post('issue_date')) ?: $invoice['issue_date'];
    $dueDate = trim((string) $Url->post('due_date'));
    $notes = trim((string) $Url->post('notes'));
    $items = invoice_parse_items_from_post($_POST);

    if ($clientId <= 0) {
        $errors[] = 'Client is required.';
    }
    if (empty($items)) {
        $errors[] = 'At least one invoice item is required.';
    }

    $validStatuses = ['Draft', 'Sent', 'Partially Paid', 'Paid', 'Overdue', 'Cancelled'];
    if (!in_array($status, $validStatuses, true)) {
        $status = 'Draft';
    }

    if (!empty($errors)) {
        invoice_edit($id, $errors, $_POST);
        return;
    }

    $saved = invoice_update_invoice($id, [
        'client_id' => $clientId,
        'status' => $status,
        'issue_date' => $issueDate,
        'due_date' => $dueDate,
        'notes' => $notes,
    ], $items);

    if (!$saved) {
        $errors[] = 'Unable to update invoice.';
        invoice_edit($id, $errors, $_POST);
        return;
    }

    Redirect('invoice/view/' . $id);
}

function invoice_delete($id)
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    invoice_soft_delete($id);
    Redirect('invoice');
}

function invoice_print($id)
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $items = invoice_get_items($invoice['id']);
    include 'containers/invoice/print.php';
}

function invoice_send($id)
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    $invoice = invoice_get_invoice($id);
    if (!$invoice || $invoice['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!invoice_can_manage($invoice)) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $items = invoice_get_items($invoice['id']);
    $notice = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!invoice_validate_csrf($Url->post('csrf_token'))) {
            $notice = ['success' => false, 'message' => 'Invalid form token.'];
        } else {
            $message = trim((string) $Url->post('message')) ?: 'Please find your invoice attached.';
            $result = invoice_send_email($invoice, $items, $message);
            $notice = [
                'success' => !empty($result['success']),
                'message' => $result['success'] ? 'Invoice email sent.' : ($result['error'] ?? 'Unable to send email.'),
            ];
        }
    }
    include 'containers/invoice/send.php';
}

function invoice_clients()
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $clients = invoice_client_list();
    $csrf = invoice_csrf_token();
    include 'containers/invoice/clients.php';
}

function invoice_client_form($client = null, $errors = [])
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    $csrf = invoice_csrf_token();
    include 'containers/invoice/client_form.php';
}

function invoice_client_create()
{
    invoice_client_form(null, []);
}

function invoice_client_edit($id)
{
    $client = invoice_get_client($id);
    if (!$client || $client['deleted_at']) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    invoice_client_form($client, []);
}

function invoice_client_save($id = null)
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    if (!invoice_validate_csrf($Url->post('csrf_token'))) {
        invoice_client_form(null, ['Invalid form token.']);
        return;
    }
    $data = [
        'name' => trim((string) $Url->post('name')),
        'email' => trim((string) $Url->post('email')),
        'phone' => trim((string) $Url->post('phone')),
        'address' => trim((string) $Url->post('address')),
        'company' => trim((string) $Url->post('company')),
    ];
    $errors = [];
    if ($data['name'] === '') {
        $errors[] = 'Client name is required.';
    }
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Client email is invalid.';
    }
    if (!empty($errors)) {
        invoice_client_form($data, $errors);
        return;
    }
    invoice_upsert_client($id, $data);
    Redirect('invoice/clients');
}

function invoice_client_delete($id)
{
    if (!invoice_require_login('invoice')) {
        return;
    }
    invoice_delete_client($id);
    Redirect('invoice/clients');
}

function invoice_settings()
{
    global $Url;
    if (!invoice_require_login('invoice')) {
        return;
    }
    if (!invoice_is_admin()) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $settings = invoice_get_settings();
    $notice = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!invoice_validate_csrf($Url->post('csrf_token'))) {
            $notice = ['success' => false, 'message' => 'Invalid form token.'];
        } else {
            $prefix = trim((string) $Url->post('prefix'));
            $nextNumber = (int) $Url->post('next_number');
            invoice_update_settings($prefix, $nextNumber);
            $settings = invoice_get_settings();
            $notice = ['success' => true, 'message' => 'Settings updated.'];
        }
    }
    $csrf = invoice_csrf_token();
    include 'containers/invoice/settings.php';
}
