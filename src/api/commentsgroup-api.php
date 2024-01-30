<?php
    require_once '../db/database.php';
    require_once '../utils/functions.php';
    $dbh = new DatabaseHelper("localhost", "root", "", "db_estotesocial", "3306");

    $idPost = $_POST["idPost"];

    //ritorna i commenti di un determinato post
    $result = $dbh->getCommentsById($idPost);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>