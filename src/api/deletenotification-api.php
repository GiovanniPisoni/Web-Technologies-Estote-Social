<?php
require_once("../db_config.php");

//redirect if not auth
if (!userIsAlreadyIn($dbh->db)) {
    header('Location: ../base-homepage.php');
}

$response = array(); // Array per contenere la risposta

$idNotifica = $_POST["idNotifica"];
$result = $dbh->removeNotification($idNotifica);

if ($result) {
    $response['message'] = 'Notifica eliminata con successo.';
} else {
    $response['message'] = 'Errore durante l\'eliminazione della notifica.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
