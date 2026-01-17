<?php


if(isset($_GET['need'])){
    $req = $_GET['need'];

    include "containers/needs/$req.php";
}

