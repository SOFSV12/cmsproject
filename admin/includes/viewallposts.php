<?php
if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $postValueId){

    $bulk_options = $_POST['bulk_options'];
    $postValueId;

      switch($bulk_options){

        case 'published':
        // sql query
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
        // executing query 
        $update_post = mysqli_query($connection, $query);
        //error handling 
        confirmQuery($update_post);
        header("Location: ./posts.php");
        break;

        case 'draft':
        // sql query
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
        // executing query 
        $update_post = mysqli_query($connection, $query);
        //error handling 
        confirmQuery($update_post);
        header("Location: ./posts.php");
        break;

        case 'delete':
        // sql query
        $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
        // executing query 
        $delete_post = mysqli_query($connection, $query);
        //error handling 
        confirmQuery($delete_post);
        header("Location: ./posts.php");
        break;


        case 'clone':
        // sql query
        $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
        // executing query 
        $select_post_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_post_query)){
            $post_id = $row['post_id'];
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date= $row['post_date'];
            $post_content= $row['post_content'];
        }
        $query = "INSERT INTO posts (post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";

        $query .= 
        "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}',
        '{$post_tags}',  '{$post_status}' )";

        $copy_query = mysqli_query($connection, $query);

        //error handling 
        confirmQuery($copy_query);
        break;
}
     }
}

?>

<form action="" method="post">
<!-- table displaying all posts -->
<table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-md-3">
        <select name="bulk_options" id="" class="form-control">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        </select>
    </div>
     <div class="cols-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <br>
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Users</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comment Count</th>
            <th>View Count</th>
            <th>Date</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
           //select all posts 
           $query = "SELECT * FROM posts ORDER BY post_id DESC";
           //send query to database
           $select_posts = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date= $row['post_date'];
            $post_views_count = $row['post_views_count'];

            echo "<tr>";

            ?>

        <td><input type='checkbox' class='checkBoxes' name="checkBoxArray[]" value="<?php echo $post_id;?>"></td>
            <?php
            
            echo "<td>{$post_id}</td>";
            // if(!empty($post_author)){
            // echo "<td>{$post_author}</td>";
            // }else if(!empty($post_user)){
                echo "<td>{$post_user}</td>";
                // }
            echo "<td>{$post_title}</td>";


            
            //sql query 
            /*to display the category title we check if the cat_id is the same 
            the category_id being fetched from the post table */
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
             //query the database 
             $select_categories = mysqli_query($connection, $query);
             while($row = mysqli_fetch_assoc($select_categories)){
         
                 $cat_id = $row['cat_id'];
                 $cat_title = $row['cat_title'];
                 echo "<td>{$cat_title}</td>";

             }
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100px' src='../images/$post_image' alt='image'></img></td>";
            echo "<td>{$post_tags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
            $send_comment_query = mysqli_query($connection, $query);
            

            if ($send_comment_query) {
                if (mysqli_num_rows($send_comment_query) > 0) {
                    //sql query
                    $row = mysqli_fetch_array($send_comment_query);
                    //
                    // $comment_id = $row['comment_id'];
                    $count_comment = mysqli_num_rows($send_comment_query);
                    echo "<td><a href='postcomments.php?id={$post_id}'>{$count_comment}<a/></td>";
                    // Rest of your code
                } else {
                    echo "<td><a href='#'>no comments<a/></td>";
                }
            } 

            echo "<td>{$post_views_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post'); \" href='posts.php?delete={$post_id}'>delete</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Change View count of Post?'); \" href='posts.php?null_view={$post_id}'>View count to zero</a></td>";
            echo "</tr>";
        }
            
           ?>
           <?php
           if(isset($_GET['delete'])){
    $post_id = escape($_GET['delete']);
     //sql query
     $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
     //send query to database
     $delete_category = mysqli_query($connection,$query);
     //refreshes the page after deleting has been completed
     header("Location: posts.php");
      //error handling for sent in query
     if ($delete_category === TRUE) {
         echo "Record deleted successfully";
     } else {
         die('QUERY FAILED' . mysqli_error($connection));
     }
}
           ?>

           <?php
           if(isset($_GET['null_view'])){
    $post_id = escape($_GET['null_view']);
     //sql query
     $num = 0;
     $query = "UPDATE posts SET post_views_count = {$num} WHERE post_id = {$post_id} ";
     //send query to database
     $edit_comment_count = mysqli_query($connection,$query);
     //refreshes the page after deleting has been completed
     header("Location: posts.php");
      //error handling for sent in query
     if ($edit_comment_count === TRUE) {
         echo "Updated successfully";
     } else {
         die('QUERY FAILED' . mysqli_error($connection));
     }
}
           ?>
        </tr>
    </tbody>
</table>
</form>
