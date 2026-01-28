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
        $api = new JX_API(errors:'no error in api home');
        $api->setMessage("Welcome to Jamilx Service");
        $api->data([
            'Endpoint' => 'apihome',
            'Resquest type' => 'GET'
        ]);
      $api->Respond();
       
    }
}