<?php

interface JX_Message_interface{
        public function from();
        public function to();
        public function body();
        
}

class JX_Message {
        
        public function get_messages($from = null)
        {
                global $Me,$JX_db;
               if(is_null($from)){
                       $me = $Me->id();
                        $sql = "SELECT  *FROM `messages` WHERE `to_id` = $me";
                        $qr = $JX_db->query($sql);
                        return $qr;
               }else{

                $me = $Me->id();
                        $sql = "SELECT  *FROM `messages` WHERE `to_id` = $me AND `from_id` = $from";
                        $qr = $JX_db->query($sql);
                        return $qr;

               }
        }
        public function get_inbox($to)
        {
                
        }

        public function get_sent()
        {
                global $Me,$JX_db;
               
                       $me = $Me->id();
                        $sql = "SELECT  *FROM `messages` WHERE `from_id` = $me";
                        $qr = $JX_db->query($sql);
                        return $qr;
               
        }
        public function update_field($msg_id,$msg_field, $msg_value)
        {
                global $Me,$JX_db;
               
                       $me = $Me->id();
                        $sql = "UPDATE `messages` SET `$msg_field` = '$msg_value' WHERE `id` = $msg_id";
                        if($JX_db->query($sql)){
                                return true;
                        }else{
                                return $JX_db->error;
                        }
                        
               
        }

        public function delete_row($msg_id)
        {
                global $Me,$JX_db;
               
                       $me = $Me->id();
                        $sql = "DELETE FROM `messages`  WHERE `id` = $msg_id";
                        if($JX_db->query($sql)){

                        }else{

                        }
                        
               
        }

        public function set_draft($msg_id)
        {
                global $Me,$JX_db;
               
                       $me = $Me->id();
                        $sql = "UPDATE `messages` SET `visibility` = 'draft' WHERE `id` = $msg_id";
                        if($JX_db->query($sql)){

                        }else{

                        }
                        
               
        }

        public function set_read($msg_id)
        {
                global $Me,$JX_db;
               
                       $me = $Me->id();
                        $sql = "UPDATE `messages` SET `status` = 'read' WHERE `id` = $msg_id";
                        if($JX_db->query($sql)){

                        }else{

                        }
                        
               
        }

        public function set_trash($id){
                return $this->update_field($id,"visibility","trash");
        }

        public function get_drafts()
        {
                global $Me,$JX_db;
               
                $me = $Me->id();
                 $sql = "SELECT  *FROM `messages` WHERE `visibility` = 'draft' AND `from_id`=$me";
                 $qr = $JX_db->query($sql);
                 return $qr;
        }

        public function get_trash()
        {
                global $Me,$JX_db;
               
                $me = $Me->id();
                 $sql2 = "SELECT  *FROM `messages` WHERE `visibility` = 'trash' AND `from_id`=$me";
                 $sql = "SELECT  *FROM `messages` WHERE `visibility` = 'trash' AND `to_id`=$me";
                 $qr = $JX_db->query($sql);
                 return $qr;
        }

        public function send($to)
        {
                global $Me,$JX_db, $Url;
                if(isset($_POST['send'])){
                 $userto = $Url->post('to');
                 $userfrom = $_SESSION['uid'];
                 $message = $Url->post('message');
         
                 $sql = "INSERT INTO `messages`(`to_id`,`from_id`,`message`,`subject`)VALUES('$userto','$userfrom','$message','testing message')";
                 if($JX_db->query($sql)){
                     echo "message sent ";
                 }else{
                     echo $JX_db->error;
                 }
                }
        }

}