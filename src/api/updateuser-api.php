<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $bio = $_POST["bio"];
    $totem = $_POST["group"];
    $group = $_POST["group"];
    $dateofbirth = $_POST["dateofbirth"];
    $username = $_POST["username"];

    $immagine = $_POST["immagine"];
    $oldImage = $dbh->getImageUser($username);
    if($immagine !== $oldImage){
        $dbh->updateImgProfilo($immagine, $username);
        deleteFile($oldImage);
    }
    $dbh->updateUser($email, $nome, $cognome, $bio, $totem, $group, $dateofbirth, $username);
?>
