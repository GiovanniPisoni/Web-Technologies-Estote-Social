<?php
    require_once("db_config.php");

    $username = $_POST["username"];

    //controlla se esiste un particolare hahshtag, in caso esista ritorna tutti i post con quel hashtag
    $result = $dbh->searchByHashtag($username);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
