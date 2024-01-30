<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["posts"] = $dbh->showPostorderByDate($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);
} else{
    header('Location: index.php');
}

$templateParams["js"] = array("js/read-notifications.js", "js/like.js", "js/comments-list.js", "components/comments-banner.php",
                                "utils/function.js", "js/add-post.js", "js/like-number.js");
require 'template/base-homepage.php';
?>
