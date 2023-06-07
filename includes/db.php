<?php
//connecting to database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cms');
 
//Create connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Check connection
if ($connection->connect_error) {
    die("Connection Failed" . $connection->connect_error);
}

?>