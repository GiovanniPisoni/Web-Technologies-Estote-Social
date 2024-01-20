<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $idPost = $_POST["idPost"];
    $testo = $_POST["testo"];
    
    //modifica un post già esistente
    $immagine = $_POST["immagine"];
    $dbh->updatePost($idPost, $testo, $immagine);
?>
