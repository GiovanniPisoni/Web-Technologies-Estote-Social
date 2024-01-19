<?php
require_once("db_config.php");
$result["login-result"] = false;
$result["login-error"] = "";

if(isset($_POST["username"]) && isset($_POST["password"])) {
  $login_result = login($_POST["username"], $_POST["password"], $dbh);
  if($login_result) {
    $result["login-result"] = true;
  } else {
    $result["login-error"] = "Username o Password errati!";
  }
} else {
    $result["login-error"] = "Username o Password non inseriti!";
}

header('Content-Type: application/json');
echo json_encode($result);

?>