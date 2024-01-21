<?php
require_once 'db_config.php';

$templateParams["title"] = "Login";
$templateParams["name"] = "template/show-login.php";

if(isset($_SESSION["user_id"])) {
  $_SESSION["user_id"] = null;
}

require '../template/Login-base.php';
?>