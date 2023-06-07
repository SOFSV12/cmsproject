<?php include "./includes/adminheader.php"?>

<?php 
/*fetching user info from database if theres is a username key value pair in sessions*/
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];

//sql query 
$query = "SELECT * FROM users WHERE username = '{$username}' ";

//execute query
$select_user_profile_query = mysqli_query($connection,$query);

//result of query
while($row = mysqli_fetch_assoc($select_user_profile_query)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_password= $row['user_password'];

}

//error handling
if(!$select_user_profile_query){
    die("QUERY FAILED" . mysqli_error($connection));
}


}
?>




    <div id="wrapper">

        <!-- Navigation -->

        <?php include "./includes/adminnavigation.php"?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">
Welcome, Admin
<small>Subheading</small>
</h1>
<?php 
if(isset($_POST['edit_user']) && isset($_SESSION['username'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password= $_POST['user_password'];

    //encrypting user password
    $crypt_md5_fmt = "$1$";
    $salt = "random_salt$";
    $hashF_and_salt = $crypt_md5_fmt . $salt;
    //hashing password
    $hashed_password = crypt($user_password,$hashF_and_salt);


    //preparing sql 

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_firstname= '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname }', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE username = '{$username}' ";

    //executing query 
    $edit_user_query = mysqli_query($connection, $query);

    //error handling 
    confirmQuery($edit_user_query); 

  
}

?>

<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value='<?php if(isset($user_firstname)){echo  $user_firstname;} ?>'>
</div>

<div class="form-group">
    <label for="author">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value='<?php if(isset($user_lastname)){echo  $user_lastname;} ?>' >
</div>




<div class="form-group">
    <label for="post_status">Username</label>
    <input type="text" class="form-control" name="username" value='<?php if(isset($username)){echo  $username;} ?>'>
</div>

<!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">Email</label>
    <input type="email" class="form-control" name="user_email" value='<?php if(isset($user_email)){echo $user_email;} ?>'>
</div>

<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="user_password" >
</div>


<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
</div>

</form>


 </div>
  </div>
  <!-- /.row -->

 </div>
 <!-- /.container-fluid -->

 </div>
            <!-- /#page-wrapper -->

        <?php include "./includes/adminfooter.php"?>