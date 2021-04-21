<?php 

    session_start();


    define('SITEURL', 'http://localhost/');
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'food-ordering');


    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error('error'));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error('error'));

    ?>
