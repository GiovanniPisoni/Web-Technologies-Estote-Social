<?php
  require_once("../db_config.php");

  $result["login_result"] = false;

  if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(login($username, $password, $dbh) == true) {
      $result["login_result"] = true;
    } else {
      $result["login_error"] = "Username o Password errati!";
    }
  } else {
      $result["login_error"] = "Username o Password non inseriti!";
  }

  header('Content-Type: application/json');
  echo json_encode($result);

?>