<?php 
    require_once("./db_config.php");

    // Decodifica l'input JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $idPost = $data["postId"];

    // Conta il numero di like
    $result["likes"] = $dbh->getLikesByPostId($idPost);

    header('Content-Type: application/json');
    echo json_encode($result);
?>