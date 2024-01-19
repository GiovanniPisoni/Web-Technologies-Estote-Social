<?php
    require_once 'db/database.php';
    require_once 'utils/functions.php';
    $dbh = new DatabaseHelper("localhost", "root", "", "estotesociallogico", "3306");
    define("UPLOAD_DIR", "img/");
    session_start_withCookies();
?>