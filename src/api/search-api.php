<?php
    require_once("../db_config.php");

    $input = $_POST["input"];

    //controlla se esiste un particolare utente, in caso esista ritorna i dati dell'utente
    $result = $dbh->searchUser($input);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
