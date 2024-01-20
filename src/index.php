<?php
  require_once 'db_config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["title"] = "Login";
    $templateParams["name"] = "show-login.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/login.js");
    require 'template/base-access.php';
  } else {
    $templateParams["title"] = "Homepage";
    $templateParams["name"] = "homepage.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/homepage.js");
    header("Location:homepage.php");
  }

?>