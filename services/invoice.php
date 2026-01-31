<?php
 
class invoice extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('Invoice Service');
    }

    public function main()
    {
        global $Url;
        $paths = $Url->get_paths();
        $action = $Url->get('action');

        if ($action === null && isset($paths[1])) {
            $redirect = 'invoice?action=' . urlencode($paths[1]);
            if (isset($paths[2])) {
                $redirect .= '&id=' . urlencode($paths[2]);
            }
            Redirect($redirect);
            return;
        }

        $action = $action ?? 'home';
        $actionMap = [
            'home' => 'invoiceindex',
            'new' => 'invoicenew',
            'view' => 'invoiceview',
            'edit' => 'invoiceedit',
            'delete' => 'invoicedelete',
            'print' => 'invoiceprint',
            'send' => 'invoicesend',
            'clients' => 'invoiceclients',
            'clients-new' => 'invoiceclientsnew',
            'clients-edit' => 'invoiceclientsedit',
            'clients-delete' => 'invoiceclientsdelete',
            'settings' => 'invoicesettings',
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
