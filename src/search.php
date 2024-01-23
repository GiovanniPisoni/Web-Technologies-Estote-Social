<?php
    require_once("db_config.php");
    $templateParams["title"] = "Search";
    $templateParams["name"] = "show-search.php";
    $templateParams["js"] = array("js/notification-viewed.js", "utils/functions.js");
    $templateParams["user_list"] = $dbh->getUsersByUsername();

    if(empty($_GET["username"])) {
        //nessun user trovato
    } else {
        //lista degli user trovati
    }
    require("template/base.php");
?>