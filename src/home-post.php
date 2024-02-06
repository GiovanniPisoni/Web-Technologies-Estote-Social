<?php
require_once("db_config.php");

//check user auth
$templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

if ($templateParams["isAuth"]) {
    $loggedUserId = $_SESSION["username"];
    $templateParams["notifiche"] = $dbh->getNotificationsByUsername($loggedUserId);
    $templateParams["loggedUserSeguiti"] = $dbh->getSeguitiByUsername($loggedUserId);
    $posts = $dbh->showPostorderByDate($loggedUserId);
    foreach ($posts as $post) {
            $postDate = strtotime($post["Data"]);
            $tenDaysAgo = strtotime("-30 days");
            if($postDate >= $tenDaysAgo):
                $templateParams["posts"][] = $post;
            endif;
    }
    $templateParams["utente"] = $dbh->getUserByUsername($loggedUserId);
} else if (!$templateParams["isAuth"]){
    header('Location: index.php');
    exit;
}

$templateParams["js"] = array("js/read-notifications.js", "utils/function.js", "js/add-post.js");
if(!empty($templateParams["posts"])) {
    array_push($templateParams["js"], "js/like.js");
    array_push($templateParams["js"], "js/comments-list.js");
    array_push($templateParams["js"], "js/like-number.js");
}
require 'template/base-homepage.php';
?>
