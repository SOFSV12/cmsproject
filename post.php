<?php include "includes/db.php"?>
    <?php include "includes/header.php"?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

          

            <?php

            if(isset($_GET['p_id'])){

                $post_id = $_GET['p_id'];

                //get number of views for this post 
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id ";
                $send_query = mysqli_query($connection,$view_query);

                //error handling 
                if(!$send_query){
                    die("QUERY FAILED" . mysqli_error($connection));

                }
            
            //sql query to fetch from post table 
            $query= "SELECT * FROM posts WHERE post_id = $post_id ";
            //query against database
            $select_all_post = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_post)){

                
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            }
                ?>
                
                <!-- <h1 class='page-header'>
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href=''><?php echo $post_title ?></a>
                </h2>
                <p class='lead'>
                    by <a href='authorposts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>'><?php echo $post_user ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span><?php echo $post_date ?></p>
                <hr>
                <img class='img-responsive' src='images/<?php echo $post_image;?>' alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>
          <?php  }
          else{
            header("Location : index.php");
          }
            ?>

            <!-- Blog Comments -->

                <!-- Comments Form -->

                <?php 
                if(isset($_POST['create_comment'])){

                    $post_id = $_GET['p_id'];
                    $comment_author =$_POST['comment_author'];
                    $comment_email =$_POST['comment_email'];
                    $comment_content =$_POST['comment_content'];

                    if(!empty($comment_author ) && !empty($comment_email) && !empty($comment_content)){
        
                  
                    
                    //sql query 
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email,
                     comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}',
                     '{$comment_content}', 'unapproved', now() ) ";

                     //executing query
                     $create_comment_query = mysqli_query($connection,$query);
                     
                     //error handling
                     if(!$create_comment_query){
                        die('QUERY FAILED' . mysqli_error($connection));
                     }

                    

                    header("Location: post.php?p_id={$post_id}");
                }
            }


                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                        <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Comment</label>
                            <textarea name="comment_content" id="" cols="30" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
        

                
                <?php
                //fetching comments from database table
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' AND comment_status = 'approved' ORDER BY comment_id ";
                //execute query
                $fetch_approved_comments = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($fetch_approved_comments)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                
                
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author?>
                            <small><?php echo  $comment_date?></small>
                        </h4>
                        <?php echo $comment_content?>
                    </div>
                </div>


                <?php }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>
        <?php include "includes/footer.php"?>

       