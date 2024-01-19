<?php
  require_once 'db_config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["titolo"] = "EstoteSocial - Home";
    require 'template/login_base.php';
  } else {
    header("Location:homepage.php");
  }

?>