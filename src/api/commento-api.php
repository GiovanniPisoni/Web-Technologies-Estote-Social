<?php
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    //inserisce un commento ad un post in base all'id
    $testo = $_POST["testo"];
    $idCommento = $_POST["idCommento"];
    $idPost = $_POST["idPost"];
    $date = $_POST["date"];
    $result["status"] = $dbh->insertComment($testo, $_SESSION["user_id"], $idPost, $date);
   
    $result["senderId"] = $_SESSION["user_id"];
    $result["receiverId"] = $dbh->getPostById($postId)[0]["userId"];

    header('Content-Type: application/json');
    echo json_encode($result);
?>