<?php

class apihome extends JX_Action implements JX_ActionI{
     public function __construct()
    {
        $this->setTitle("Welcome to JamilX API service");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/api/api.php";
    }
    public function getApi()
    {
        echo json_encode([
            'status' => 1,
            'data' => [
                'message' =>" welcome to JamilX Api Service"
            ]
        ]);
    }
}