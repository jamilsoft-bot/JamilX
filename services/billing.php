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
        $paths = $Url->get_paths();
        $action = $Url->get('action');

        if ($action === null && isset($paths[1])) {
            $redirect = 'billing?action=' . urlencode($paths[1]);
            if (isset($paths[2])) {
                $redirect .= '&id=' . urlencode($paths[2]);
            }
            Redirect($redirect);
            return;
        }

        $action = $action ?? 'home';
        $actionMap = [
            'home' => 'billingdashboard',
            'payments' => 'billingpayments',
            'new-payment' => 'billingnewpayment',
            'refund' => 'billingrefund',
        ];

        $actionClass = $actionMap[$action] ?? null;
        if (!$actionClass || !class_exists($actionClass)) {
            http_response_code(404);
            include 'containers/common/error.php';
            return;
        }

        $getAction = new $actionClass();
        $getAction->getAction();
    }
}
