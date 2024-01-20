<?php
   require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $idNotifica = $_POST["idNotifica"];
    
    //disabilita la visualizzazione di una particolare notifica
    $result = $dbh->leggiNotifica($idNotifica);
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>
