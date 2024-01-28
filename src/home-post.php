<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

$templateParams["posts"] = $dbh->showPostorderByDate($_SESSION["username"]);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);

    $templateParams["js"] = array("js/read-notifications.js", "js/like.js", "js/comments-list.js",
                                    "utils/function.js", "js/add-post.js", "js/new-comment.js");
} else {
    $templateParams["js"] = array("utils/function.js");
}

require 'template/base-homepage.php';
?>
