<?php
    require_once 'db/database.php';
    require_once 'utils/functions.php';
    $dbh = new DatabaseHelper("localhost", "root", "", "db_estotesocial", "3306");
    define("UPLOAD_DIR", "img/");

    if(!isset($_SESSION)) {
        session_start_withCookies();
    }
?>