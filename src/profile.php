<?php
require_once 'home-post.php';

//redirect if not auth
if(!$templateParams["isAuth"] || !isset($_GET["id"])){
    header('Location: index.php');
}

$currentUserId = $_GET["id"];

$templateParams["titolo"] = "OnTopic - Profilo";
$templateParams["contenuto"] = "profilo-template.php";

/* Controllo se il qp è corretto*/
$templateParams["utenteProfilo"] = $dbh->getUserByUsername($currentUserId);
if(!$templateParams["utenteProfilo"]) {
    header('Location: index.php');
}

$templateParams["posts"] = $dbh->getPostByUsername($currentUserId);
$templateParams["seguaci"] = $dbh->getFollowerByUsername($currentUserId);
$templateParams["seguiti"] = $dbh->getSeguitiByUsername($currentUserId);
array_push($templateParams["js"], "js/follow.js", "js/usersList.js");

require 'template/base-homepage.php';
?>
