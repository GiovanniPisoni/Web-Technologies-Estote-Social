<?php
   require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }
   
    
  
    
    //disabilita la visualizzazione di una particolare notifica
    //qui dobbiamo mettere una funzione che controlla se l'utente clicca sopra la notifica allora
    //la notifica deve essere disabilitata

    $result = $dbh->isReadNotification($_POST["id"]);

    header('Content-Type: application/json');
    echo json_encode($result);