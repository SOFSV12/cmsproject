
<div class="col-md-4">


<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <!-- form to search blog post to filter available blog post -->
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form><!-- search form -->
    <!-- /.input-group -->
</div>

<!-- LOGIN FORM  -->
<div class="well">
    <h4>LOGIN</h4>
    <!-- form to search blog post to filter available blog post -->
    <form action="includes/login.php" method="post">
   
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Enter username">
    </div>
    <div class="input-group">
        <input name="password" type="password" class="form-control" placeholder="Enter password">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name="login">Submit</button>
        </span>
    </div>
    </form><!-- search form -->
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

            <?php 
                // Read operation: fetching data from db 
                //sql query to get category titles for side bar
                $query = "SELECT * FROM categories";
                //query the database 
                $select_categories_sidebar = mysqli_query($connection, $query);
            ?>


    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php
                while($row = mysqli_fetch_assoc($select_categories_sidebar)){

                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        
    </div>
    <!-- /.row -->
</div>

<?php include "widget.php"?>

</div>