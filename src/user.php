<?php
require_once 'base-posts.php';

//redirect if not auth
if(!$templateParams["isAuth"] || !isset($_GET["id"])){
    header('Location: index.php');
}

$currentUsername = $_GET["username"];

$templateParams["titolo"] = "Estote Social - Profilo";
$templateParams["contenuto"] = "user-template.php";

/* Controllo se il qp è corretto*/
$templateParams["utenteProfilo"] = $dbh->getUserByUsername($currentUsername);
if(!$templateParams["utenteProfilo"]) {
    header('Location: index.php');
}

$templateParams["posts"] = $dbh->getPostByUsername($currentUsername);
$templateParams["seguaci"] = $dbh->getFollowerByUsername($currentUsername);
$templateParams["seguiti"] = $dbh->getSeguitiByUsername($currentUsername);
array_push($templateParams["js"], "js/follow.js", "js/usersList.js");

require 'template/base-homepage.php';
?>