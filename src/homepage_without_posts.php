<?php
    require_once("./db_config.php");

    $templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

    if($templateParams["isAuth"]) {
        $loggedUserId = $_SESSION["username"];
        $templateParams["notification"] = $dbh->getNotificationsByUsername($loggedUserId);
        $templateParams["notificationUnread"] = $dbh->getNotificationsByUsername($loggedUserId); //TODO: CHIEDI A JACK SE VA BENE
        $templateParams["loggedUser"] = $dbh->getFollowerByUsername($loggedUserId);
        $templateParams["utente"] =  $dbh->getUserByUsername($loggedUserId);
    }

    $templateParams["js"] = array("./js/notificationsHandle.js", "./utils/functions.js"); //TODO: add notificationsHandle.js?