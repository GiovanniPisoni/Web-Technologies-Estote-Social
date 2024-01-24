<?php
require_once 'base-without-posts.php';

//redirect if not auth
if(!$templateParams["isAuth"]){
    header('Location: index.php');
}

$templateParams["titolo"] = "Estote Social - Aggiungi Post";
$templateParams["contenuto"] = "newpost.php";


require 'template/base.php';
?>