<?php

    //Function to check if the user login is correct
    function login($username, $password, $dbh) {
        $checkLogin = $dbh->checkLogin($username, $password);

        if($checkLogin) {

            $username = $checkLogin[0]["username"]; //Retrieve username from database
            $passwordDB = $checkLogin[0]["password"]; //Retrieve password from database
            $salt = $checkLogin[0]["salt"]; //Retrieve salt from database
            //DA AGGIUNGERE AL DATABASE

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
                    $dbh->loginAttempt($username, $now); //We record this attempt in the database
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
        $attemptResult = $dbh->loginAttempt($username, $valid_attempts); //Check if there are more than 5 attempts in the last hour

        if(count($attemptResult) > 3) {
            return true;
        } else {
            return false;
        }
    }

    //Function that check if the user is already logged in
    function userIsAlreadyIn($mysqli) {
        
    }

?>