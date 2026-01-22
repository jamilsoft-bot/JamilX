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
        $segment = $paths[1] ?? null;

        if ($segment === null && $Url->get('action') !== null) {
            $segment = $Url->get('action');
        }

        switch ($segment) {
            case 'new':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    invoice_store();
                } else {
                    invoice_create();
                }
                break;
            case 'view':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                invoice_view($id);
                break;
            case 'edit':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    invoice_update($id);
                } else {
                    invoice_edit($id);
                }
                break;
            case 'delete':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                invoice_delete($id);
                break;
            case 'print':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                invoice_print($id);
                break;
            case 'send':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                invoice_send($id);
                break;
            case 'clients':
                invoice_clients();
                break;
            case 'clients-new':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    invoice_client_save();
                } else {
                    invoice_client_create();
                }
                break;
            case 'clients-edit':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    invoice_client_save($id);
                } else {
                    invoice_client_edit($id);
                }
                break;
            case 'clients-delete':
                $id = (int) ($paths[2] ?? $Url->get('id'));
                invoice_client_delete($id);
                break;
            case 'settings':
                invoice_settings();
                break;
            case 'home':
            case null:
                invoice_index();
                break;
            default:
                http_response_code(404);
                include 'containers/common/error.php';
                break;
        }
    }
}
