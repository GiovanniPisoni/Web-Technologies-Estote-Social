<?php
    require_once("../db_config.php");

    $idPost = $_POST["idPost"];
    
    //rimuove un particolare post
    $result = $dbh->deletePostById($idPost);
    
    header('Content-Type: application/json');
    echo json_encode($result);
?>