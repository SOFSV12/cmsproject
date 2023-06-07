<?php include "db.php"?>
<?php session_start() ?>

<?php

header("Location: ../index.php");

 $_SESSION['username'] = null;
 $_SESSION['firstname'] = null;
 $_SESSION['lastname'] = null;
 $_SESSION['user_role'] = null;

 header("Location: ../index.php");
?>