<?php

function billing_dashboard()
{
    if (!billing_require_login('billing')) {
        return;
    }
    $stats = billing_dashboard_stats();
    include 'containers/billing/dashboard.php';
}

function billing_payments()
{
    global $Url;
    if (!billing_require_login('billing')) {
        return;
    }
    $page = max(1, (int) $Url->get('page'));
    $perPage = 10;
    $invoiceId = $Url->get('invoice_id');
    $payments = billing_fetch_payments($page, $perPage, ['invoice_id' => $invoiceId]);
    $total = billing_count_payments(['invoice_id' => $invoiceId]);
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
    ];
    include 'containers/billing/payments.php';
}

function billing_new_payment($errors = [], $values = [])
{
    if (!billing_require_login('billing')) {
        return;
    }
    $csrf = billing_csrf_token();
    include 'containers/billing/payment_form.php';
}

function billing_store_payment()
{
    global $Url;
    if (!billing_require_login('billing')) {
        return;
    }
    $errors = [];
    if (!billing_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token.';
    }
    $invoiceId = (int) $Url->post('invoice_id');
    $amount = (float) $Url->post('amount');
    $method = trim((string) $Url->post('method'));
    $notes = trim((string) $Url->post('notes'));

    if ($invoiceId <= 0) {
        $errors[] = 'Invoice is required.';
    }
    if ($amount <= 0) {
        $errors[] = 'Payment amount must be greater than zero.';
    }

    if (!empty($errors)) {
        billing_new_payment($errors, $_POST);
        return;
    }

    if (!billing_record_payment($invoiceId, $amount, $method, $notes)) {
        $errors[] = 'Unable to record payment.';
        billing_new_payment($errors, $_POST);
        return;
    }

    Redirect('billing?action=payments');
}

function billing_refund_form($paymentId, $errors = [], $values = [])
{
    if (!billing_require_login('billing')) {
        return;
    }
    $payment = billing_get_payment($paymentId);
    if (!$payment) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $csrf = billing_csrf_token();
    include 'containers/billing/refund_form.php';
}

function billing_refund_save($paymentId)
{
    global $Url;
    if (!billing_require_login('billing')) {
        return;
    }
    $errors = [];
    if (!billing_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token.';
    }
    $refundAmount = (float) $Url->post('refund_amount');
    $notes = trim((string) $Url->post('notes'));
    if ($refundAmount <= 0) {
        $errors[] = 'Refund amount must be greater than zero.';
    }

    if (!empty($errors)) {
        billing_refund_form($paymentId, $errors, $_POST);
        return;
    }

    if (!billing_refund_payment($paymentId, $refundAmount, $notes)) {
        $errors[] = 'Unable to process refund.';
        billing_refund_form($paymentId, $errors, $_POST);
        return;
    }

    Redirect('billing?action=payments');
}

class billingdashboard extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Billing Dashboard');
    }

    public function getAction()
    {
        billing_dashboard();
    }
}

class billingpayments extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Payments');
    }

    public function getAction()
    {
        billing_payments();
    }
}

class billingnewpayment extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Record Payment');
    }

    public function getAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            billing_store_payment();
            return;
        }
        billing_new_payment();
    }
}

class billingrefund extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Refund Payment');
    }

    public function getAction()
    {
        global $Url;
        $id = (int) $Url->get('id');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            billing_refund_save($id);
            return;
        }
        billing_refund_form($id);
    }
}
