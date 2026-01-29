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
        $segment = $paths[1] ?? null;

        if ($segment === null && $Url->get('action') !== null) {
            $segment = $Url->get('action');
        }

        switch ($segment) {
            case 'payments':
                billing_payments();
                break;
            case 'new-payment':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    billing_store_payment();
                } else {
                    billing_new_payment();
                }
                break;
            case 'refund':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    billing_refund_save($id);
                } else {
                    billing_refund_form($id);
                }
                break;
            case 'home':
            case null:
                billing_dashboard();
                break;
            default:
                http_response_code(404);
                include 'containers/common/error.php';
                break;
        }
    }
}
