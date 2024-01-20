<?php 
    require_once("db_config.php");

    $username = $_SESSION["username"];

    
    $result = $dbh->getAllPostOfFollowedUsers($username);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
