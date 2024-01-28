<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);
}

//redirect if not auth
if(!$templateParams["isAuth"]){
    header('Location: index.php');
}

$templateParams["titolo"] = "Cerca";
$templateParams["contenuto"] = "show-search.php";
$templateParams["js"] = array("js/read-notifications.js", "utils/functions.js", "js/add-post.js", "js/search.js");

require 'template/base-homepage.php';
?>
