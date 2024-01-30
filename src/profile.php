<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["userposts"] = $dbh->getPostByUsername($loggedUserId);
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["loggedUserSeguaci"] = $dbh->getFollowerByUsername($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);
} else{
    header('Location: index.php');
}

$templateParams["titolo"] = "Profilo";
$templateParams["nome"] = "show-profile.php";
$templateParams["js"] = array("js/read-notifications.js", "js/comments-list.js", "utils/function.js", "components/comments-banner.php",
                                "js/add-post.js", "js/post-management.js", "js/modify-post.js");

require 'template/base-homepage.php';
?>
