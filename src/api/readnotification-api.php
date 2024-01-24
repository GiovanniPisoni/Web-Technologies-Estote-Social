<?php
require_once("../db_config.php");

//redirect if not auth
if (!userIsAlreadyIn($dbh->db)) {
    header('Location: ../base-homepage.php');
}

$response = array(); // Array per contenere la risposta

$idNotifica = $_POST["idNotifica"];

if (!$dbh->isReadNotification($idNotifica)) {
    $result = $dbh->readNotification($idNotifica);

    if ($result) {
        $response['message'] = 'Notifica segnata come letta con successo.';
    } else {
        $response['message'] = 'Errore durante l\'aggiornamento della notifica.';
    }
} else {
    $response['message'] = 'La notifica è già stata letta in precedenza.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
