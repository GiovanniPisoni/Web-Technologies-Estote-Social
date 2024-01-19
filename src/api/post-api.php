<?php 
    require_once("db_config.php");

    $userId = $_SESSION["user_id"];
    $testo = $_POST['testo'];

    $response["userId"] = $userId;
    $currDay = date("Y-m-d H:i:s");

    // Modifica: Recupera i valori dagli input del form
    $hashtag1 = isset($_POST['hashtag1']) ? $_POST['hashtag1'] : null;
    $hashtag2 = isset($_POST['hashtag2']) ? $_POST['hashtag2'] : null;
    $hashtag3 = isset($_POST['hashtag3']) ? $_POST['hashtag3'] : null;
    $hashtag=array($hashtag1,$hashtag2,$hashtag3);
    //inserisce nuovo post (con immagine nullable)
    if(isset($_POST['immagine'])) {
        $immagine = $_POST['immagine'];
        if(isset($testo)){
            $dbh->insertPost($immagine, $userId, $currDay, $hashtag, $testo);
        } else {
            $dbh->insertPost($immagine, $userId, $currDay, $hashtag, null);
        }
        //testo non può essere null nel nostro db 
    } else if($testo != null) {
        $dbh->insertPost(null, $userId, $currDay, $hashtag, $testo);
    }

    header('Content-Type: application/json');
    echo json_encode($response["userId"]);
?>
