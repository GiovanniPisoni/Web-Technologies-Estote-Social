<?php 
    require_once("../db_config.php");

    //rimuove il follow se già presente, o aggiunge il follow ad un particolare utente (da parte dell'utente loggato)
    $usernameSeguito = $_POST["usernameseguito"];
    $remove = false;
    if(isset($_POST["remove"])) {
        $remove = $_POST["remove"];
    }

    if($remove){
        $dbh->unfollow($_SESSION["username"], $usernameSeguito);
    } else {
        $dbh->follow($_SESSION["username"], $usernameSeguito); 
    }
    $result["senderUsername"] = $_SESSION["username"];
    $result["receiverUsername"] = $usernameSeguito;

    header('Content-Type: application/json');
    echo json_encode($result);
?>
