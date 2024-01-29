<?php 
    require_once("../db_config.php");

    $idPost = $_POST["idPost"];

    //controllo se l'utente loggato abbia o meno messo mi piace al post
    $liked = $dbh->getLikesByUserAndPostId($_SESSION["username"], $idPost);

    if($liked){
        $result["isLiked"] = true;
    } else {
        $result["isLiked"] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
