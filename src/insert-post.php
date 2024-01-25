<?php
    require_once ("db_config.php");

    //redirect if not auth
    if(!$templateParams["isAuth"]){
        header('Location: index.php');
    }

    $templateParams["titolo"] = "Estote Social - Aggiungi Post";
    $templateParams["contenuto"] = "template/add-post.php";


    require 'template/base-homepage.php';
?>