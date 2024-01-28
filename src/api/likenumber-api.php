<?php 
    require_once("./db_config.php");

    //conta il numero di like
    $idPost = $_POST["postId"];

    $result["likes"] = $dbh->getLikesByPostId($idPost);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
