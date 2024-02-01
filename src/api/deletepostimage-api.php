<?php 
    require_once("../db_config.php");

   $idPost = $_POST["idPost"];

   //elimina una determinata immagine dal file system (img post)
   $dbh->deletePostImage($idPost);

   header('Content-Type: application/json');
   echo json_encode($result);

?>
