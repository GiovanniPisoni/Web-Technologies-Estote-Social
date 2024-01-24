<?php
   require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    if($dbh->isReadNotification($_POST["idNotifica"]) == false){
        $result = $dbh->readNotification($_POST["idNotifica"]);
    }


    header('Content-Type: application/json');
    echo json_encode($result);