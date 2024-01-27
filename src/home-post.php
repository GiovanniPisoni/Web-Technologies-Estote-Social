<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

//Base Template
$templateParams["post"] = "post-template.php";

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);

    $templateParams["js"] = array("js/read-notifications.js", "js/like.js", "js/comments-list.js", "js/new-comment.js",
    "components/comments-modal/comments-modal.js", "components/postSettings-modal/postSettings-modal.js", "js/post-management.js", "utils/functions.js");
} else {
    $templateParams["js"] = array("utils/functions.js");
}
?>
