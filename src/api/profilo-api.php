<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $bio = $_POST["bio"];
    $gruppo = $_POST["gruppo"];

    $result["status"] = false;

    if(isset($_POST["immagine"])) {
        $immagine = $_POST["immagine"];
        if(isset($_POST["fazzolettone"])) {
            $fazzolettone = $_POST["fazzolettone"];
            if(isset($_POST["specialita"])) {
                $specialita = $_POST["specialita"];
                if(isset($_POST["totem"])) {
                    $totem = $_POST["totem"];
                    $result["status"] = $dbh->updateUser($nome, $cognome, $email, $bio, $gruppo, $immagine, $fazzolettone, $specialita, $totem);
                } else {
                    $result["status"] = $dbh->updateUser($nome, $cognome, $email, $bio, $gruppo, $immagine, $fazzolettone, $specialita, null);
                }
            } else {
                $result["status"] = $dbh->updateUser($nome, $cognome, $email, $bio, $gruppo, $immagine, $fazzolettone, null, null);
            }
        } else {
            $result["status"] = $dbh->updateUser($nome, $cognome, $email, $bio, $gruppo, $immagine, null, null, null);
        }
    } else {
        $result["status"] = $dbh->updateUser($nome, $cognome, $email, $bio, $gruppo, null, null, null, null);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
