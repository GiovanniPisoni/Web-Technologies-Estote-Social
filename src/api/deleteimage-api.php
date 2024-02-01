<?php 
    require_once("../db_config.php");

   //redirect if not auth
   if(!userIsAlreadyIn($dbh->db)){
        header('Location: ../index.php');
    }

   $img = $_POST["removeimage"];

   //elimina una determinata immagine dal post e dal file system (img post)
   $path = "./img/" + $img;
   deleteFile($path);

   header('Content-Type: application/json');
   echo json_encode($result);

?>
