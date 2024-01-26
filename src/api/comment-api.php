<?php
    require_once("../db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ../index.php');
    }

    //inserisce un commento ad un post in base all'id
    $testo = $_POST["testo"];
    $idCommento = $_POST["idCommento"];
    $idPost = $_POST["idPost"];
    $date = date("Y-m-d H:i:s");
    $result["status"] = $dbh->insertComment($testo, $_SESSION["username"], $idPost, $date);
   
    $result["senderUsername"] = $_SESSION["username"];
    $result["receiverUsername"] = $dbh->getUsernameByIdPost($idPost)["username"];

    header('Content-Type: application/json');
    echo json_encode($result);
?>
