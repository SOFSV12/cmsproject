<?php 

if(isset($_POST['create_user'])){
   $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
  $user_lastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);
  $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);
  $username = mysqli_real_escape_string($connection,$_POST['username']);
  $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
  $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);

  $crypt_md5_fmt = "$1$";
  $salt = "random_salt$";
  $hashF_and_salt = $crypt_md5_fmt . $salt;
  //hashing password
  $hashed_password = crypt($user_password,$hashF_and_salt);


  //sql query
  $query = "INSERT INTO users (user_firstname,user_lastname,user_role,username,user_email,user_password) ";

  $query .= 
  "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}','{$username}', '{$user_email}',
  '{$hashed_password}' )";
  
  //execute query on db
  
  $create_user_query = mysqli_query($connection, $query);
  
  
  if($create_user_query){
      echo "SUCCESFUL";
     }else{
       die('QUERY FAILED' . mysqli_error($connection));
     }

    echo '<br><a href="users.php">View Users</a><br><br>';

  
}

?>

<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="author">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
<select name="user_role" id="">
    <option value="">Select option</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>>
</select>

   
</div>


<div class="form-group">
    <label for="post_status">Username</label>
    <input type="text" class="form-control" name="username">
</div>

<!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">Email</label>
    <input type="email" class="form-control" name="user_email">
</div>

<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" class="form-control" name="user_password">
</div>


<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>

</form>