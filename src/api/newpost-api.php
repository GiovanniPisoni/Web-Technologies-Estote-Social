<?php 
    require_once("db_config.php");

    $username = $_SESSION["username"];
    $testo = $_POST['testo'];

    $response["username"] = $username;
    $currDay = date("Y-m-d H:i:s");

    // Modifica: Recupera i valori dagli input del form
    $hashtag1 = isset($_POST['hashtag1']) ? $_POST['hashtag1'] : null;
    $hashtag2 = isset($_POST['hashtag2']) ? $_POST['hashtag2'] : null;
    $hashtag3 = isset($_POST['hashtag3']) ? $_POST['hashtag3'] : null;
    if(isset($hashtag1) && isset($hashtag2) && $hashtag1 === $hashtag2){
        $hashtag2 = null;
    }
    if(isset($hashtag1) && isset($hashtag3) && $hashtag1 === $hashtag3){
        $hashtag3 = null;
    }
    if(isset($hashtag2) && isset($hashtag3) && $hashtag2 === $hashtag3){
        $hashtag3 = null;
    }


    //inserisce nuovo post (con immagine nullable)
    if(isset($_POST['immagine'])) {
        $immagine = $_POST['immagine'];
        $dbh->insertPost($immagine, $username, $currDay, $testo, $hashtag1, $hashtag2, $hashtag3);
        //testo non può essere null nel nostro db 
    } else if($testo != null) {
        $dbh->insertPost(null, $username, $currDay, $testo, $hashtag1, $hashtag2, $hashtag3);
    }

    header('Content-Type: application/json');
    echo json_encode($response["username"]);
?>
