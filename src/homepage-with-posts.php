<?php
    require_once("./db_config.php");

    $templateParams["isAuth"] = userIsAlreadyIn($dbh->db);
    $templateParams["post"] = "show-post-home.php";
    $templateParams["posts"] = $dbh->getAllPosts(); //TODO: get all posts from the database

    if($templateParams["isAuth"]) {
        $loggedUserId = $_SESSION["username"];
        $templateParams["notification"] = $dbh->getNotificationsByUsername($loggedUserId);
        $templateParams["notificationUnread"] = $dbh->getNotificationsByUsername($loggedUserId); //TODO: CHIEDI A JACK SE VA BENE
        $templateParams["loggedUser"] = $dbh->getFollowerByUsername($loggedUserId);
        $templateParams["utente"] =  $dbh->getUserByUsername($loggedUserId);

        $templateParams["js"] = array("");
    } else {
        $tempalteParams["js"] = array("./utils/functions.js");
    }
?>