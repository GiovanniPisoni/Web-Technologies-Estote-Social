<?php
  require_once 'db_config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["title"] = "Login";
    $templateParams["name"] = "show-login.php";
    $templateParams["js"] = array("js/login.js");
    require 'template/base-access.php';
  } else {
    $templateParams["title"] = "Homepage";
    $templateParams["name"] = "show-homepage.php";
    $templateParams["js"] = array("js/homepage.js");
    require 'template/base-homepage.php';
    header("Location:homepage.php");
  }

?>