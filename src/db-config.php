<?php
    require_once 'db/database.php';
    require_once 'functions.php';
    $dbh = new DatabaseHelper("localhost", "root", "", "EstoteSocial", "3306");
    define("UPLOAD_DIR", "img/");
    session_start_withCookies();
?>