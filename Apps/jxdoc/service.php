<?php

class jxdoc extends JX_Serivce implements JX_service{

  public function main(){
    include "main.php";
  }
}

class dochome extends JX_Action implements JX_ActionI{
  private $native = "";
  public function __construct()
  {
      // $this->setTitle("Welcome to ");
      // $this->setTopic("Madarasatu Haniyfatid deneel Islam");
      // //$this->setText("")
  }
  public function addAction()
  {
      include "Apps/jxdoc/containers/home.php";
  }

  public function getAction()
  {
      include "Apps/jxdoc/containers/home.php";
  }
 
}
