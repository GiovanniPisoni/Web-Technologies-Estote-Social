<?php 
    require_once '../db/database.php';
    require_once '../utils/functions.php';
    $dbh = new DatabaseHelper("localhost", "root", "", "db_estotesocial", "3306");


    //conta il numero di like
    $idPost = $_POST["idPost"];

    $result["likes"] = (int) $dbh->getLikesByPostId($idPost);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
