<?php
   require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }
    $username = $_SESSION["username"];
    $result = $dbh->getNotificationsByUsername($username);

  
    
    //disabilita la visualizzazione di una particolare notifica
    //qui dobbiamo mettere una funzione che controlla se l'utente clicca sopra la notifica allora
    //la notifica deve essere disabilitata
    
    
    

    header('Content-Type: application/json');
    echo json_encode($result);
?>
