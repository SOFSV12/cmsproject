<?php 
   
            if(isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];
            }
            //select all posts 
           $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
           //send query to database
           $select_posts_by_id = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_posts_by_id)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_category_id = $row['post_category_id'];
            $post_content = $row['post_content'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date= $row['post_date'];

            if(isset($_POST['update_post'])){

                $post_title = mysqli_real_escape_string($connection,$_POST['title']);
                $post_author = mysqli_real_escape_string($connection,$_POST['post_user']);
                $post_category_id = mysqli_real_escape_string($connection,$_POST['post_category']);
                $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);

                $post_image = mysqli_real_escape_string($connection,$_FILES['image']['name']);
                //where file s temporarily stored
                $post_image_temp = mysqli_real_escape_string($connection,$_FILES['image']['tmp_name']);

                $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
                $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
                

                //moving uploaded file from temp location to a permanent location
                move_uploaded_file($post_image_temp, "../images/$post_image");

                

                /*if a new image has not be selected and the form says no
                image selected, the function below selects the image 
                associated with the id of the post from the post table in cms
                database*/ 
                if(empty($post_image)){
                    // sql query
                    $query =   "SELECT * FROM posts WHERE post_id = {$post_id} ";
                    // executing query 
                    $select_image = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_image)){
                        $post_image = $row['post_image'];

                    }
                }

                //preparing sql 

                $query = "UPDATE posts SET ";
                $query .= "post_title = '{$post_title}', ";
                $query .= "post_category_id = '{$post_category_id}', ";
                $query .= "post_date = now(), ";
                $query .= "post_author = '{$post_author}', ";
                $query .= "post_status = '{$post_status}', ";
                $query .= "post_tags = '{$post_tags}', ";
                $query .= "post_content = '{$post_content}', ";
                $query .= "post_image = '{$post_image}' ";
                $query .= "WHERE post_id = '{$post_id}' ";

                //executing query 
                $update_post = mysqli_query($connection, $query);

                //error handling 
                confirmQuery($update_post);

                // header("Location: ../post.php?p_id={$post_id}");
                header("Location: ./posts.php");

                echo "
                <p class='bg-success'><a href='../post.php?p_id={$post_id}'>View Post</a> OR <a href='posts.php'>Edit more Post</a></p>";

              
            }
            ?>

          
            
          

<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" value='<?php if(isset($post_title)){echo $post_title;} ?>'>
</div>

<div class="form-group">
<div>
        <label for="post_category">Post Category</label>
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
    <option value="<?php echo $post_user; ?>"><?php echo"Author is" . " " . $post_user?></option>



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
    <div>
        <label for="post_status">Post Status</label>
    </div>

<select name="post_status" id="post_status">
<option value="<?php echo $post_status;?>"><?php if(isset($post_status)){echo $post_status;} ?></option>
<?php
if($post_status == 'published'){
   echo "<option value='draft'>Draft</option>";
}else{
   echo "<option value='published'>Publish</option>";
}
?>
   
</select>

</div>

<div class="form-group">
    <img src="../images/<?php echo $post_image; ?>" alt="" width="100px">
    <input type="file"  name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value='<?php if(isset($post_tags)){echo $post_tags;} ?>'>
</div>

<div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" name="post_content"  id="summernote" cols="30" rows="10" ><?php if(isset($post_content)){echo $post_content;} ?></textarea>
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>

</form>


<?php
 }
 
    ?>