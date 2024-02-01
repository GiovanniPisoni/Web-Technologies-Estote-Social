<?php
require_once("db_config.php");

$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
} else if (!$templateParams["isAuth"]){
    header('Location: index.php');
    exit;
}

$currentUsername = $_GET["username"];
$templateParams["utente"] = $dbh->getUserByUsername($currentUsername);

if($templateParams["utente"] == null){
    header('Location: index.php');
    exit;
} else {
    $templateParams["userposts"] = $dbh->getPostByUsername($currentUsername);
    $templateParams["currentUserSeguiti"] = $dbh->getSeguitiByUsername($currentUsername);
    $templateParams["currentUserSeguaci"] = $dbh->getFollowerByUsername($currentUsername);
}

$templateParams["title"] = "Profilo";
$templateParams["name"] = "show-profile.php";
$templateParams["js"] = array("js/read-notifications.js", "js/comments-list.js", "utils/function.js",
                                "js/add-post.js", "js/post-management.js", "js/modify-post.js", "js/userList.js");

require 'template/base-homepage.php';
?>
