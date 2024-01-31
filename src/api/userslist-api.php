<?php
    require_once("../db_config.php");

    $username = $_POST["username"];
    $type = $_POST["listType"];

    //ritorna la lista dei seguiti o dei seguaci (in base al body della req)
    if($type == "follower"){
        $result = $dbh->getFollowerByUsername($username);
    } else if($type == "seguiti"){
        $result = $dbh->getSeguitiByUsername($username);
    }

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
