<?php 
    require_once("../db_config.php");

   $result["signin-result"] = false;

   //inserisco l'utente nel db se non esiste già
   if(isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['name'], $_POST['surname'],
            $_POST['email'], $_POST['image'], $_POST['birthday'], $_POST['group'], $_POST['bio'])) {
        //controllo che le password coincidano
        if($_POST['password'] == $_POST['password_confirm']) {
            //eseguo l'hash della password e genero il sale
            $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            // Crea una password usando la chiave appena creata.
            $password = hash('sha512', $_POST["password"] . $salt);
            //controllo se esiste un utente con lo stesso user, altrimenti esegui l'inserimento
            if($dbh->getUserByUsername($_POST["username"])) {
                $result["erroreSignin"] = "Username già in uso";
            } else if($dbh->insertUser($_POST['username'], $_POST['name'], $_POST["surname"], $_POST["birthday"],
                        $_POST['image'], $_POST['group'], $_POST['email'], $password, $salt, $_POST['bio'],
                        null, null, null)) {
                $result["signin-result"] = true;
            }
        } else {
            // Le due password non corrispondono.
            $result["erroreSignin"] = "Le password non coincidono";
        }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["erroreSignin"] = "Registrazione fallita";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>
