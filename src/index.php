<?php
  require_once 'db_config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["title"] = "EstoteSocial - Login";
    $templateParams["name"] = "login.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/login.js");
    require 'template/login_base.php';
  } else {
    $templateParams["title"] = "EstoteSocial - Homepage";
    $templateParams["name"] = "homepage.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/homepage.js");
    header("Location:homepage.php");
  }

?>