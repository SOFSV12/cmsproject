<?php 

if(isset($_POST['create_post'])){

   
  $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
  $post_user = mysqli_real_escape_string($connection,$_POST['post_user']);
  $post_category_id = mysqli_real_escape_string($connection,$_POST['post_category']);
  $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);

  $post_image = mysqli_real_escape_string($connection,$_FILES['image']['name']);
  //where file s temporarily stored
  $post_image_temp = mysqli_real_escape_string($connection,$_FILES['image']['tmp_name']);

  $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
  $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
  $post_date = date('d-m-y');
  


  move_uploaded_file($post_image_temp, "../images/$post_image");

  //sql query
$query = "INSERT INTO posts (post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";

$query .= 
"VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}',
'{$post_tags}',  '{$post_status}' )";

//execute query on db

$create_post_query = mysqli_query($connection, $query);

 
$post_id = mysqli_insert_id($connection);

echo "<p class='bg-success'><a href='../post.php?p_id={$post_id}'>View Post</a> OR <a href='posts.php'>Edit more Post</a></p>";

if($create_post_query){
    echo "SUCCESFUL";
    
    // header("Location: ../post.php?p_id={$post_id}");

    header("Location: ./posts.php");
    
    
   }else{
     die('QUERY FAILED' . mysqli_error($connection));
   }
  
}



?>

<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title">
</div>

<div class="form-group">
    <div>
        <label for="post_category">Categories</label>
    </div>
    <select name="post_category" id="post_category">


    <?php
    
    $query = "SELECT * FROM categories";

    //query the database 
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)){

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo " <option value='{$cat_id}'>{$cat_title}</option>";
    }

    ?>
    </select>

   
</div>

<div class="form-group">
    <div>
        <label for="post_user">Post Author</label>
    </div>
    <select name="post_user" id="post_user">
        <option value="">select user</option>


    <?php
    
    $query = "SELECT * FROM users WHERE user_role = 'admin' ";

    //query the database 
    $select_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users)){

        $user_id = $row['user_id'];
        $username = $row['username'];

        echo " <option value='{$username}'>{$username}</option>";
    }

    ?>
    </select>

   
</div>


<div class="form-group">
    
    <select name="post_status" id="post_status">
    <option value="">Post Status</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    </select>
</div>

<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" name="post_content"  id="summernote" cols="30" rows="10"></textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>

</form>