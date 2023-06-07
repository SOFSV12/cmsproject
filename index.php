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

            //number of post per page
            $post_per_page = 5;

            //checking if the "page" is not set to null
            if(isset($_GET['page'])){
            //assign $_GET['page'] to a variable $page
                $page = $_GET['page'];
            }else {
                $page = '';
            }

            if($page == '' || $page == 1){
                // variable is for the limit
                $rows_to_offset = 0;
            }else{
                $rows_to_offset = ($page * $post_per_page ) - $post_per_page;
            }
            //adding pagination feature 

            //sql query
             $querybub = "SELECT * FROM posts";
             //execute query
             $select_all_post = mysqli_query($connection, $querybub);
             //count result
             $post_count = mysqli_num_rows($select_all_post);
             $post_count = ceil($post_count / $post_per_page);
 
            //  echo "<h1>{$post_count}<h1/>";

            //sql query to fetch from post table 
            $query= "SELECT * FROM posts LIMIT $rows_to_offset, $post_per_page ";
            //query against database
            $select_all_post = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_post)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];

                if($post_status == 'published'){

                 

               
                
                ?>
                
                <!-- <h1 class='page-header'>
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                <a href='post.php?p_id=<?php echo $post_id;?>'><?php echo $post_title ?></a>
                </h2>
                <p class='lead'>
                    by <a href='authorposts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>'><?php echo $post_user ?>  </a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> <?php echo $post_date ?></p>
                <hr>
                <a href='post.php?p_id=<?php echo $post_id;?>'>
                <img class='img-responsive' src='images/<?php echo $post_image;?>' alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>
          <?php  } 
            }
          
            ?>
              

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <ul class="pager">
            <?php
            for($i = 1; $i <= $post_count; $i++){
                if($i == $page){
                    //add style to page which user is currently on
                    echo "<li><a class='activelink' href='index.php?page={$i}'>{$i}</a></li>";
                }else{
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
                    
                }
            ?>
            
        </ul>

        <hr>
        <?php include "includes/footer.php"?>

       