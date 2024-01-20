<?php 
    require_once("db_config.php");

    $username = $_POST["username"];

    $result = $dbh->getUsersByUsername($username);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
