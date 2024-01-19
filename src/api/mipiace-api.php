<?php 
    require_once("db_config.php");

    //redirect if not auth
    if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }
    //questa api va modificata, nel nostro db possiamo calcolare 
    //direttamente il numero di likes di un post tramite una query
    //rimuove un mi piace ad un post se già presente, o ne aggiunge uno
    $idPost = $_POST["postId"];
    $remove = false;
    if(isset($_POST["remove"])) {
        $remove = $_POST["remove"];
    }

    if($remove){
        $dbh->decrementLikesById($idPost);
        $dbh->removeLike($idPost, $_SESSION["user_id"]);
    } else {
        $dbh->incrementLikesById($idPost);
        $dbh->insertLike($idPost, $_SESSION["user_id"]);
    }
    $result["likes"] = $dbh->getLikesByPostId($idPost);
    $result["senderId"] = $_SESSION["user_id"];
    $result["receiverId"] = $dbh->getPostById($idPost)[0]["userId"];

    header('Content-Type: application/json');
    echo json_encode($result);
?>
