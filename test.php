<?php
$password = "Emmanuel";
$crypt_md5_fmt = "$1$";
$salt = "random_salt$";
$hashF_and_salt = $crypt_md5_fmt . $salt;
//hashing password
$hashed_password = crypt($password,$hashF_and_salt);
echo $hashed_password;

?>