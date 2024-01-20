<?php
    require_once("db_config.php");

    $testo = $_POST["testo"];

    //controlla se esiste un particolare utente, in caso esista ritorna i dati dell'utente
    $result = $dbh->searchUser($testo);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
