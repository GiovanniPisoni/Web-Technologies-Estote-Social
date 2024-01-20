<?php 
   require_once("db_config.php");

   $result["notificationStatus"] = false;

   //inserisce la notifica sul db per visualizzarla nel sito, invia la notifica email al destinatario
   if(isset($_POST["type"], $_POST["sender"], $_POST["receiver"]) && ($_POST["receiver"] != $_SESSION["username"])) { 
         //get sender username and receiver email
         $sender = $dbh->getUsersByUsername($_POST["sender"])[0];
         //add notification to db
         if($dbh->insertNotification($_POST["type"], $_POST["receiver"], $_POST["sender"], false)) {
            //get receiver email
            $receiver = $dbh->getUsersByUsername($_POST["receiver"])[0];
            if($sender && $receiver) {
               //send notification via email
               if(sendNotificationEmail($sender["username"], $receiver["email"], $_POST["type"])) {
                  //ok
                  $result["notificationStatus"] = true;
               }
            }
        }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["erroreNotification"] = "Richiesta non valida";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

   function composeMessage($type, $senderUsername) {
      $messages = [
         "follow" => "L'utente <strong>" . $senderUsername . "</strong> ha iniziato a seguirti",
         "like" => "L'utente <strong>" . $senderUsername . "</strong> ha messo mi piace ad un tuo post",
         "comment" => "L'utente <strong>" . $senderUsername . "</strong> ha commentato un tuo post"
     ];
     return $messages[$type];
   }

?>
