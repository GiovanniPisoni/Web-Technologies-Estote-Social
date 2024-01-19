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

    //inserisce nuovo post (con immagine nullable)
    if(isset($_POST['immagine'])) {
        $immagine = $_POST['immagine'];
        if(isset($testo)){
            $dbh->insertPost($immagine, $testo, $userId, $currDay, $hashtag);
        } else {
            $dbh->insertPost($immagine, null, $userId, $currDay, $hashtag);
        }
    } else if($testo != null) {
        $dbh->insertPost(null, $testo, $userId, $currDay, $hashtag);
    }

    header('Content-Type: application/json');
    echo json_encode($response["userId"]);
?>
