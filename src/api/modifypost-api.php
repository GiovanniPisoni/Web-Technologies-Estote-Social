<?php 
    require_once("../db_config.php");

    $idPost = $_POST["idPost"];
    $testo = $_POST["testo"];
    $hashtag1 = $_POST["hashtag1"];
    $hashtag2 = $_POST["hashtag2"];
    $hashtag3 = $_POST["hashtag3"];
    
    if(isset($_POST["immagine"])) {
        $immagine = $_POST["immagine"];
        $oldImage = $dbh->getImageIdPost($idPost);
        if($immagine !== $oldImage){
            $dbh->updatePostImage($idPost, $immagine);
        }
    }
    $dbh->updatePost($idPost, $testo, $hashtag1, $hashtag2, $hashtag3);
?>
