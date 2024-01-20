<?php 
    require_once("db_config.php");

    $username = $_POST["username"];

    //controllo il follow dell'utente loggato ad un particolare utente
    $followed = $dbh->checkFollow($_SESSION["user_id"], $username);

    if(empty($followed)){
        $result["followed"] = false;
    } else {
        $result["followed"] = true;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
