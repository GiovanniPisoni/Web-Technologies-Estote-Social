<?php
    require_once("db_config.php");

    $username = $_POST["username"];

    //controlla se esiste un particolare utente, in caso esista ritorna i dati dell'utente
    $result = $dbh->getUsersByUsername($username);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
