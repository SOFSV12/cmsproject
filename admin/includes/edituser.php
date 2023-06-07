<?php 
if(isset($_GET['user_id'])){
$the_user_id = escape($_GET['user_id']);
//select all posts 
$query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
//send query to database
$select_users = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_users)){
 $user_id = $row['user_id'];
 $username = $row['username'];
 $user_firstname = $row['user_firstname'];
 $user_lastname = $row['user_lastname'];
 $user_email = $row['user_email'];
 $user_image = $row['user_image'];
 $user_role= $row['user_role'];
 $user_password= $row['user_password'];

}

}

if(isset($_POST['edit_user'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
     

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
    $query .= "user_password = '{$hashed_password}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = '{$the_user_id}' ";

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
<select name="user_role" id="">
<option value="<?php echo $user_role; ?>"><?php echo"current role is" . " " . $user_role?></option>
<?php
if($user_role == 'admin'){
   echo "<option value='subscriber'>Subscriber access</option>";
}else{
   echo "<option value='admin'>Administration access</option>";
}
?>    
</select>
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
    <input type="email" class="form-control" name="user_email" value='<?php if(isset($user_email)){echo  $user_email;} ?>'>
</div>

<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" class="form-control" name="user_password" value='<?php if(isset($user_password)){echo   $user_password;} ?>'>
</div>


<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Add User">
</div>

</form>