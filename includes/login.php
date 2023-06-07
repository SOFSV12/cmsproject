<?php include "db.php"?>
<?php session_start() ?>

<?php 
if(isset($_POST['login'])){
   $username =  $_POST['username'];
   $password =  $_POST['password'];

   //preventing sql injection
   //user provided username
   $username = mysqli_real_escape_string($connection, $username);
   //user provided password
   $password = mysqli_real_escape_string($connection, $password);


   //sql query
   $query = "SELECT * FROM users WHERE username = '{$username}' ";

   //execute query 
   $select_user_query = mysqli_query($connection, $query);

   //error handling 
   if(!$select_user_query){
    die("QUERY FAILED" . " " . mysqli_error($connection));
   }

   while($row = mysqli_fetch_assoc($select_user_query)){
       $db_user_id = $row['user_id'];
       $db_user_firstname = $row['user_firstname'];
       $db_user_lastname = $row['user_lastname'];
       $db_username = $row['username'];
       $db_user_role= $row['user_role'];
       $db_user_password = $row['user_password'];
   }
//getting a password hash


   if(password_verify($password,$db_user_password)){

      header("Location: ../admin/index.php");

   //creating a session 
   $_SESSION['username'] = $db_username;
   $_SESSION['firstname'] = $db_user_firstname ;
   $_SESSION['lastname'] = $db_user_lastname;
   $_SESSION['user_role'] = $db_user_role;
   
 

   }else{

    header("Location: ../index.php");
    

   }
}
?>