<?php
    require_once("../db_config.php");

    $input = "#" . $_POST["input"];


    //controlla se esiste un particolare hashtag, in caso esista ritorna i post con quel particolare hashtag
    $result = $dbh->getPostByHashtag($input);

    if(empty($result)){
        $result = array();
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
