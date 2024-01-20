<?php 
    require_once("db_config.php");

   //redirect if not auth
   if(!userIsAlreadyIn($dbh->db)){
        header('Location: ./../index.php');
    }

   $idPost = $_POST["idPost"];

   //elimina una determinata immagine dal post e dal file system (img post)
   $path = $dbh->getImageIdPost($idPost);
   $dbh->deletePostImage($idPost);
   deleteFile("../img/", $path);

   header('Content-Type: application/json');
   echo json_encode($result);

?>
