<?php 
    require_once("db_config.php");

    // Redirect if not authenticated
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }
//dobbiamo fare si che se uno non inserisce nulla, nell'update non vengano modificati i campi che non ha inserito
    // Recupera i dati dal post
    $email = $_POST["email"];
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
    $cognome = isset($_POST["cognome"]) ? $_POST["cognome"] : NULL;
    $bio = $_POST["bio"];
    $gruppo = isset($_POST["gruppo"]) ? $_POST["gruppo"] : NULL;
    $immagine = isset($_POST["immagine"]) ? $_POST["immagine"] : NULL;
    $fazzolettone = isset($_POST["fazzolettone"]) ? $_POST["fazzolettone"] : NULL;
    $specialita = isset($_POST["specialita"]) ? $_POST["specialita"] : NULL;
    $totem = isset($_POST["totem"]) ? $_POST["totem"] : NULL;

    // Effettua l'aggiornamento dell'utente
    $dbh->updateUser($email, $nome, $cognome, $image, $bio, $fazzolettone, $specialita, $totem, $gruppo, $dateofbirth, $username);

    // Risponde in formato JSON
    header('Content-Type: application/json');
    echo json_encode($result);
?>
