<?php
    require_once("db_config.php");

    $username = $_POST["username"];

    //cerca un particolare hahshtag e ritorna tutti i post con quel hashtag (per esempio sotto ad un post clicca su un hashtag di quel post ed escono
    //tutti i post con quel hashtag)
    $result = $dbh->getPostByHashtag($username);

    if(empty($result)){
        $result = false;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
