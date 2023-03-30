<?php
$ProtoRoles = new JX_RolesP();
class createrole extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        if(isset($_POST['rolebtn'])){
            global $ProtoRoles;
            $name = $_POST['name'];
            $sum = $_POST['summary'];
            $cat = $_POST['category'];
            if($ProtoRoles->insert("name,summary,category","'$name','$sum','$cat'")){
                JX_Alert("Role added to the record");
            }else{
                JX_Alert("Role cannot be added now","","red");
            }
        }
        include "containers/roles/create.php";
    }

    

    public function addAction()
    {

    }

    


}

class readroles extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        include "containers/roles/read.php";
    }

    

    public function addAction()
    {

    }

    public function readroles(){
        global $ProtoRoles;
        
        $all = $ProtoRoles->readall();

        foreach($all as $unit){
            echo "<tr>";
            echo "<td>". $unit['id'] . "</td>";
            echo "<td>". $unit['name'] . "</td>";
            echo "<td>". $unit['summary'] . "</td>";
            echo "<td>". $unit['date'] . "</td>";
            echo "<td> actions</td>";
            echo "</tr>";

        }
        
    }


}