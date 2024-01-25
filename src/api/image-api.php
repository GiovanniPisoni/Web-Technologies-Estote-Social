<?php 
   require_once("../db_config.php");

   $result["uploadEseguito"] = false;

   //upload the image to the filesystem
   if(isset($_FILES['image'])) { 
        $uploadResult = uploadImage("../img/", $_FILES["image"]);
        if($uploadResult[0]) {
            $result["uploadEseguito"] = true;
            $result["fileName"] = $uploadResult[1];
        } else {
            $result["erroreUpload"] = "Upload immagine non riuscito";
        }
   } else { //The correct POST variables were not sent to this page.
      $result["erroreUpload"] = "Richiesta per l'upload fallito";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>
