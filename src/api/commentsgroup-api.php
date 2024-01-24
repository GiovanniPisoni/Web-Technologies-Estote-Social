<?php
    require_once("../db_config.php");

    $idPost = $_POST["idPost"];

    //ritorna i commenti di un determinato post
    $result = $dbh->getCommentsById($idPost);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>