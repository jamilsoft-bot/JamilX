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
        $action = $Url->get('action') ?? 'home';
        $actionMap = [
            'home' => 'invoicehome',
            'view' => 'invoiceview',
            'new' => 'invoicenew',
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
