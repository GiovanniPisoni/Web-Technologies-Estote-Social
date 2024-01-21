<?php 
   include '../utils/functions.php';

   $result["upload-completed"] = false;

   //upload the image to the filesystem
   if(isset($_FILES['immagine'])) { 
        $uploadResult = uploadImage("../img/", $_FILES["immagine"]);
        if($uploadResult[0]) {
            $result["uploadEseguito"] = true;
            $result["fileName"] = $uploadResult[1];
        } else {
            $result["erroreUpload"] = "Upload immagine non riuscito";
        }
   } else { //The correct POST variables were not sent to this page.
      $result["erroreUpload"] = "Richiesta non valida";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>
