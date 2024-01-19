<?php
    require_once("db_config.php");

    $postId = $_POST["postId"];

    //ritorna i commenti di un determinato post
    $result = $dbh->getCommentsById($postId);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>