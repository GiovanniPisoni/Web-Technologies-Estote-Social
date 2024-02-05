<?php
require_once("db_config.php");

$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);
} else{
    header('Location: index.php');
}

$templateParams["title"] = "Cerca";
$templateParams["name"] = "show-search.php";
$templateParams["js"] = array("js/read-notifications.js", "utils/function.js", "js/add-post.js", "js/search.js");

require 'template/base-homepage.php';
?>
