<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $idPost = $_POST["idPost"];
    $testo = $_POST["testo"];
    $hashtag1 = $_POST["hashtag1"];
    $hashtag2 = $_POST["hashtag2"];
    $hashtag3 = $_POST["hashtag3"];

    
    //modifica un post già esistente
    //prima modifica l'immagine se è stata cambiata, poi modifica il resto
    $immagine = $_POST["immagine"];
    $oldImage = $dbh->getImageIdPost($idPost);
    if($immagine !== $oldImage){
        $dbh->updatePostImage($idPost, $immagine);
        deleteFile($oldImage);
    }
    $dbh->updatePost($idPost, $testo, $hashtag1, $hashtag2, $hashtag3);
?>
