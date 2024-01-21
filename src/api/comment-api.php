<?php
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    //inserisce un commento ad un post in base all'id
    $testo = $_POST["testo"];
    $idCommento = $_POST["idCommento"];
    $idPost = $_POST["date"];
    $date = $_POST["idPost"];
    $result["status"] = $dbh->insertComment($testo, $_SESSION["username"], $idPost, $date);
   
    $result["senderId"] = $_SESSION["username"];
    $result["receiverId"] = $dbh->getUsernameByIdPost($postId)[0]["username"];

    header('Content-Type: application/json');
    echo json_encode($result);
?>
