<?php

    //Function that start the session with cookies
    function session_start_withCookies() {
        $session_name = 'session_withCookies'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id.
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.
    }

    //Function to check if the user login is correct
    function login($username, $password, $dbh) {
        $checkLogin = $dbh->checkLogin($username, $password);

        if($checkLogin) {

            $username = $checkLogin[0]["username"]; //Retrieve username from database
            $passwordDB = $checkLogin[0]["password"]; //Retrieve password from database
            $salt = $checkLogin[0]["salt"]; //Retrieve salt from database

            $password = hash('sha512', $password . $salt); //Hash with SHA512 algorithm the password with the unique salt.

            if(checkBruteForce($username, $dbh) == true) {
                //ritorno false siccome l'account è bloccato
                return false;
            } else {
                if($passwordDB == $password) {
                    //Password is correct
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; //Get the user-agent string of the user.
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha256', $password . $user_browser);
                    return true;
                } else {
                    //Password is not correct
                    $now = time();
                    $dbh->insertLoginAttempt($username, $now); //We record this attempt in the database
                    return false;
                }
            }
        } else {
            //Username doesn't exist
             return false;
        }
    }

    //Function that check if there was some brute force attack
    function checkBruteForce($username, $dbh) {
        
        $now = time();//Get the current time
        $valid_attempts = $now - (60 * 60); //Set the valid attempts to 1 hours ago
        $attemptResult = $dbh->getloginAttempt($username, $valid_attempts); //Check if there are more than 5 attempts in the last hour

        if(count($attemptResult) > 3) {
            return true;
        } else {
            return false;
        }
    }

    //Function that check if the user is already logged in
    function userIsAlreadyIn($mysqli) {
        if(isset($_SESSION['username'],$_SESSION['login_string'])) {
            $username = $_SESSION['username']; //Get the username of the user
            $login_string = $_SESSION['login_string']; //Get the login string of the user
            $user_browser = $_SERVER['HTTP_USER_AGENT']; //Get the user-agent string of the user.
            
            if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ? LIMIT 1")) {
                $stmt->bind_param('s', $username); //Bind "$username" to parameter.
                $stmt->execute(); //Execute the prepared query.
                $stmt->store_result();
                
                if($stmt->num_rows == 1) { //check if the user exists
                    $password = ''; // If so ...
                    $stmt->bind_result($password); //...get variables from result.
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);
                    
                    if($login_check == $login_string) {
                        //Logged In
                        return true;
                    } else {
                        //Not logged
                        return false;
                    }
                } else {
                    //Not logged
                    return false;
                }
            } else {
                //Not logged
                return false;
            }
        } else {
            //Not logged
            return false;
        }
    }

function uploadImage($path, $image){
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }

        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }

?>