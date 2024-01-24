<?php
require_once("db_config.php");

$templateParams["title"] = "Search";
$templateParams["name"] = "show-search.php";
$templateParams["js"] = array("js/notification-viewed.js", "utils/functions.js");

$search = $_GET["username"];
$errorMessage = ""; // Inizializza la variabile dell'errore

if (empty($search)) {
    $errorMessage = "Nessun utente trovato";
} else {
    $result = $dbh->searchUser($search);
    if (empty($result)) {
        $errorMessage = "Nessun utente trovato";
    } else {
        $templateParams["users_list"] = $result;
    }
}

$templateParams["errorMessage"] = $errorMessage; // Passa il messaggio di errore al template
require("template/base.php");
?>
