<?php

class ecneworder extends JX_Serivce implements JX_service{

    public function __construct(){
        
    }

    public function getAction(){

    }

    public function main(){
        if(isset($_GET['id'])){
            $this->getform();
        }else if(isset($_GET['key'])){
            echo "I see key";
        }else{
            $this->geterror();

        }
    }

    public function geterror(){
        echo "<h1>No Product is Selected</h1>";
    }

    public function getform(){

        $data  = $this->getproduct();
        include "neworder-container.php";
    }


    public function getproduct(){
        global $JX_db;
        $id = intval($_GET['id']);
        $sql = "SELECT *FROM `kani_courses` WHERE `id`=$id";
        $x = $JX_db->query($sql);

        return $x->fetch_assoc();
        
    }

    

    public function addAction(){
        if(isset($_GET['id'])){
            $this->getform();
        }else{
            $this->geterror();
        }    }
}

class ecordersubmit extends JX_Serivce implements JX_service{
            public $Order_key = null;

    public function __construct(){
        
    }

    public function getAction(){

    }

    public function main(){
        if(isset($_POST['submit'])){
            
        $this->getmessage($this->process());
           

        }else{
            $this->geterror();
        }
    }

    public function geterror(){
        echo "<h1>No Product is Selected</h1>";
    }

    public function process(){
        $product_id = $_POST['productid'];
        $user_id = $_POST['orderby'];
        $customer_name = $_POST['cfullname'];
        $pname = $_POST['pname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $price = $_POST['price'];
        $email = $_POST['email'];
        $quantity = '';//$_POST['quantity'];
        $shipping = $_POST['period'];
        $order_key = uniqid();
        $powner = $_POST['powner'];
        $pshop = 234;
        
        global $JX_db;

        $sql = "INSERT INTO `ecorders`(`pshop`,`cowner`,`price`,`cname`,`status`,`cid`,`orderby`,`customer_name`,`address`,`phone`,`email`,`quantity`,`period`,`orderkey`)VALUES('$pshop','$powner','$price','$pname','pending','$product_id','$user_id','$customer_name','$address','$phone','$email','$quantity','$shipping','$order_key')";

        if($JX_db->query($sql)){
          return $order_key;
        }else{
            return $JX_db->error;
        }
        
        
    }

    public function getmessage($key){

        $data  = $this->getorderid($key);
        include "order-confirmation.php";
    }


    public function getorderid($key){
        global $JX_db;
        $id = $key;
        $sql = "SELECT *FROM `ecorders` WHERE `orderkey`='$id'";
        $x = $JX_db->query($sql);

        return $x->fetch_assoc();
        
    }

    

    public function addAction(){
        echo "welcome to order form";
    }
}

class ecorderlist extends JX_Action implements JX_ActionI{

    public function __construct(){
        
    }

    public function getText()
    {
        return "Manage your order list here";

    }

    public function getTitle()
    {
        return "Order list";

    }

    public function getAction(){

    }

    public function main(){
        
    }

    public function geterror(){
        echo "<h1>No Product is Selected</h1>";
    }

    public function getlist(){
        global $JX_db;
        $sql = "SELECT *FROM `ecorders`";
        return $JX_db->query($sql);

    }


    public function getproduct(){
        global $JX_db;
        $id = intval($_GET['id']);
        $sql = "SELECT *FROM `posts` WHERE `id`=$id";
        $x = $JX_db->query($sql);

        return $x->fetch_assoc();
        
    }

    

    public function addAction(){
        include "order-list.php";
    }
}

class eccheckorder extends JX_Action implements JX_ActionI{
    public $Order_key = null;

    public function __construct(){

    }

    public function getAction(){

    }

   

    public function geterror(){
        echo "<h1>No Product is Selected</h1>";
    }

    
    public function addAction(){
        include "checkorder.php";
    }
}