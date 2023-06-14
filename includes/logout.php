<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";
session_start(); 

header("Location: ../index.php");

 $_SESSION['username'] = null;
 $_SESSION['firstname'] = null;
 $_SESSION['lastname'] = null;
 $_SESSION['user_role'] = null;

 session_destroy();
?>