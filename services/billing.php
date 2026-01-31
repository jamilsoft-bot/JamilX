<?php
 
class billing extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('Billing Service');
    }

    public function main()
    {
        global $Url;
        $action = $Url->get('action') ?? 'home';
        $actionMap = [
            'home' => 'billinghome',
            'payments' => 'billingpayments',
            'new-payment' => 'billingnewpayment',
            'refund' => 'billingrefund',
        ];

        $actionClass = $actionMap[$action] ?? $actionMap['home'];

        if (class_exists($actionClass)) {
            $handler = new $actionClass();
            $handler->getAction();
            return;
        }

        http_response_code(404);
        include 'containers/common/error.php';
    }
}
