<?php 
//add user operation
addUser();

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
    <option value="">Select Role</option>
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