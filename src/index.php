<?php
  require_once 'db_config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["titolo"] = "EstoteSocial - Home";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/login.js");
    require 'template/login_base.php';
  } else {
    header("Location:homepage.php");
  }

?>