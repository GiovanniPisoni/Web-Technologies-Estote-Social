<?php
require_once("db-config.php");
$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["profile"] = $dbh->getUserByUsername($_SESSION["username"]);
$templateParams["js"] = array("js/notification-viewed.js", "utils/functions.js");
if(empty($_GET["type"])) {
    $_GET["type"] = "posted";
}
require("template/base.php");
?>