<!-- form for updating category -->
<form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Update Category</label>
            <?php
   //function to select id of category to update
global $connection;
   if(isset($_GET['edit'])){
    $cat_id = $_GET['edit'];
    //sql query 
    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
     //query the database 
     $select_categories = mysqli_query($connection, $query);
     while($row = mysqli_fetch_assoc($select_categories)){
 
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];
         ?>
         <input name="cat_title" value='<?php if(isset($cat_title)){echo $cat_title;} ?>' type="text" class="form-control" >
 <?php
 }
 }
    ?>

    <?php 
    //update operation
    if(isset($_POST['update_category'])){
        $the_cat_title = $_POST['cat_title'];
        //sql query
        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
        //send query to database
        $update_query = mysqli_query($connection,$query);
        //error handling
        if(!$update_query){
           die('QUERY FAILED' . mysqli_error($connection));
        }
    }
    ?>


        </div>
        <div class="form-group">
            <input type="submit" name="update_category" value="Edit Category" class="btn btn-primary">
        </div>
    </form>