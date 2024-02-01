<?php
  require_once 'db_config.php';

  $templateParams["isAuth"] = userIsAlreadyIn($dbh->db);

  if(!$templateParams["isAuth"]) {
    $templateParams["title"] = "Login";
    $templateParams["name"] = "show-login.php";
    $templateParams["js"] = array("js/login.js");
    require 'template/base-access.php';
  } else {
    $templateParams["title"] = "Homepage";
    $templateParams["name"] = "show-post-home.php";
    $templateParams["js"] = array("js/read-notifications.js", "js/add-post.js", "utils/function.js");
    require 'home-post.php';
  }

?>