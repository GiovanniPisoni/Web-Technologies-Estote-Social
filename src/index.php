<?php
  require_once 'db-config.php';

  if(!isset($_SESSION["userId"])) {
    $templateParams["titolo"] = "EstoteSocial - Home";
    require 'template/Login-base.php';
  } else {
    header("Location:homepage.php");
  }

  include"start.php"
?>