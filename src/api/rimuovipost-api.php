<?php
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $postId = $_POST["idPost"];
    
    //rimuove un particolare post
    $result = $dbh->deletePostById($idPost);
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>