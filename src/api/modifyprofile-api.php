<?php 
    require_once("../db_config.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $bio = $_POST["bio"];
    $totem = $_POST["totem"];
    $group = $_POST["group"];
    $birthday = $_POST["birthday"];
    
    if(isset($_POST["immagineProfilo"])) {
        $immagine = $_POST["immagineProfilo"];
        $dbh->updateImgProfilo($username, $immagine);
    }
    if(isset($_POST["imgFazzolettone"])) {
        $dbh->deleteFazzolettone($username);
        $imgfazzolettone = $_POST["imgFazzolettone"];
        $dbh->updateFazzolettone($username, $imgfazzolettone);
    }
    if(isset($_POST["imgSpecialita"])) {
        $dbh->deleteSpecialita($username);
        $imgspecialita = $_POST["imgSpecialita"];
        $dbh->updateSpecialita($username, $imgspecialita);
    }
    $result = $dbh->updateUser($email, $name, $surname, $bio, $totem, $group, $birthday, $username);

    header('Content-Type: application/json');
    echo json_encode($result);
?>
