<?php
$ProtoCats = new JX_CatP();
class createcat extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        if(isset($_POST['rolebtn'])){
            global $ProtoCats;
            $name = $_POST['name'];
            $sum = $_POST['summary'];
            $cat = $_POST['cat'];
            if($ProtoCats->insert("name,summary,parent","'$name','$sum','$cat'")){
                JX_Alert("Category added to the record");
            }else{
                JX_Alert("Category cannot be added now","","red");
            }
        }
        include "containers/cats/create.php";
    }

    

    public function addAction()
    {

    }

    


}

class readcats extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        include "containers/cats/read.php";
    }

    

    public function addAction()
    {

    }

    public function readcats(){
        global $ProtoCats;
        
        $all = $ProtoCats->readall();

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