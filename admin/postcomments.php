<?php include "./includes/adminheader.php"?>


    <div id="wrapper">

        <!-- Navigation -->

        <?php include "./includes/adminnavigation.php"?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">
Welcome to comments
<small>Author</small>
</h1>

<!-- table displaying all posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Respone to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
           //select all posts
           $post_id_from_url = mysqli_real_escape_string($connection,$_GET['id']); 
           $query = "SELECT * FROM comments WHERE comment_post_id = $post_id_from_url ";
           //send query to database
           $select_comments = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id= $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
           

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            //sql query
            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
            //executing query
            $select_post_id_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                
            }

            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='postcomments.php?delete={$comment_id}'>delete</a></td>";
            echo "</tr>";
        }
            
           ?>
           <?php




// delete comment operation
           if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
     //sql query
     $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";
     //send query to database
     $delete_category = mysqli_query($connection,$query);
     //refreshes the page after deleting has been completed
     header("Location: comments.php");
      //error handling for sent in query
     if ($delete_category === TRUE) {
         echo "Record deleted successfully";
     } else {
         die('QUERY FAILED' . mysqli_error($connection));
     }
}
// unapprove comment operation
           if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];
    $unapprove = 'unapproved';
     //sql query
     $query = "UPDATE comments SET comment_status = '{$unapprove}' WHERE comment_id = {$the_comment_id} ";
     //send query to database
     $unapprove_comment_query = mysqli_query($connection,$query);
     //refreshes the page after deleting has been completed
     header("Location: comments.php");
      //error handling for sent in query
     if ($unapprove_comment_query === TRUE) {
         echo "Record deleted successfully";
     } else {
         die('QUERY FAILED' . mysqli_error($connection));
     }
}
// approve comment operation
           if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $approve = 'approved';
     //sql query
     $query = "UPDATE comments SET comment_status = '{$approve}' WHERE comment_id = {$the_comment_id} ";
     //send query to database
     $approve_comment_query = mysqli_query($connection,$query);
     //refreshes the page after deleting has been completed
     header("Location: comments.php");
      //error handling for sent in query
     if ($approve_comment_query === TRUE) {
         echo "Record deleted successfully";
     } else {
         die('QUERY FAILED' . mysqli_error($connection));
     }
}
           ?>
        </tr>
    </tbody>
</table>
</div>
  </div>
  <!-- /.row -->

 </div>
 <!-- /.container-fluid -->

 </div>
            <!-- /#page-wrapper -->

        <?php include "./includes/adminfooter.php"?>