<?php 
    require_once("../db_config.php");

    $idPost = $_POST["idPost"];

    //ritorna il post in base all'id
    $result = $dbh->getPostById($idPost);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
