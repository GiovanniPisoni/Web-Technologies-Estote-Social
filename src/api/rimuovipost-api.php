<?php
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $postId = $_POST["postId"];
    
    //rimuove un particolare post
    $result = $dbh->deletePostById($postId);
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>