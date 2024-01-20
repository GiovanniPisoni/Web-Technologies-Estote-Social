<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $idPost = $_POST["idPost"];
    $testo = $_POST["testo"];
    
    //modifica un post già esistente
    if(isset($_POST["immagine"])) {
        $immagine = $_POST["immagine"];
        $dbh->updatePostWithImage($idPost, $testo, $immagine);
    } else {
        $dbh->updatePostWithoutImage($idPost, $testo);
    }
?>
