<?php 
    require_once("../db_config.php");

    // Redirect if not authenticated
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ../index.php');
    }

    // Recupera i dati dal post
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $bio = $_POST["bio"];
    $gruppo = $_POST["gruppo"];
    $totem = $_POST["totem"];
    $dateofbirth = $_POST["dateofbirth"];
    $image = $_POST["image"];
    $fazzolettone = $_POST["fazzolettone"];
    $specialita = $_POST["specialita"];

    // Effettua l'aggiornamento dell'utente
    $dbh->updateUser($email, $nome, $cognome, $bio, $totem, $gruppo, $dateofbirth, $username);
    $oldImage = $dbh->getImageUser($username);
    if($image !== $oldImage){
        $dbh->updateImgProfilo($username, $image);
        deleteFile($oldImage);
    }

    $oldfazzolettone = $dbh->getFazzolettone($username);
    if($fazzolettone === null) {
        $dbh->deleteFazzolettone($username);
        deleteFile($oldfazzolettone);
    } else if($fazzolettone !== $oldfazzolettone){
        $dbh->updateFazzolettone($username, $fazzolettone);
        deleteFile($oldfazzolettone);
    }

    $oldSpecialita = $dbh->getSpecialita($username);
    if($specialita === null) {
        $dbh->deleteSpecialita($username);
        deleteFile($oldSpecialita);
    } else if($specialita !== $oldSpecialita){
        $dbh->updateSpecialita($username, $specialita);
        deleteFile($oldSpecialita);
    }

    // Risponde in formato JSON
    header('Content-Type: application/json');
    echo json_encode($result);
?>
