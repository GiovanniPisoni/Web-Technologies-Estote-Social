<?php 
   require_once("db_config.php");

   $result["notificationStatus"] = false;

   //inserisce la notifica sul db per visualizzarla nel sito
   if(isset($_POST["type"], $_SESSION["username"], $_POST["receiver"]) && ($_POST["receiver"] != $_SESSION["username"])) { 
         //add notification to db
        if($dbh->insertNotification($_POST["type"], $_POST["receiver"], $_SESSION["username"], false)) {
            $result["notificationStatus"] = true;
        } else {
            $result["erroreNotification"] = "Errore nell'inserimento della notifica";
        }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["erroreNotification"] = "Richiesta non valida";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>
