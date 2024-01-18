<?php
// requires a connection with the database

$templateParams["titolo"] = "EstoteSocial - Home";

if(!isset($_SESSION["userId"])) {
  // @todo: show start page if there's not an open session
} else {
  // @todo show homepage
}

include"start.php"
?>