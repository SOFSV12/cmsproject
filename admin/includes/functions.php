<?php
//1. create New Category.
function insertCategory(){
    global $connection;
    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];
    
        if($cat_title == '' || empty($cat_title)){
            echo "<span> Please insert a category<span/>";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUE('$cat_title') ";
    
            //send query to database 
            $create_category_query = mysqli_query($connection,$query);

            //error handling for sent in query
            if ($create_category_query) {
                echo "New Category Created";
        }else{
            die('QUERY FAILED' . mysqli_error($connection));
        }
     }
        
        }
}

//2. Select all categories 
    function findAllCategories(){
        global $connection;
          // Read operation: fetching data from db sql query to get category titles for side bar
          $query = "SELECT * FROM categories";

          //query the database 
          $select_categories = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_categories)){

              $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];

              echo "<tr>";
              echo "<td>{$cat_id}</td>";
              echo "<td>{$cat_title}</td>";
              echo "<td><a href='categories.php?delete={$cat_id}'>delete</a></td>";
              echo "<td><a href='categories.php?edit={$cat_id}'>edit</a></td>";
              echo "</tr>";
          }
        
    }

//3. update categories 
function updateCategories(){
    if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        include "./includes/updatecategories.php";
    }
}

//4. Delete Categories 
function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        //sql query
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id } ";
        //send query to database
        $delete_category = mysqli_query($connection,$query);
        //refreshes the page after deleting has been completed
        header("Location: categories.php");
         //error handling for sent in query
        if ($delete_category === TRUE) {
            echo "Record deleted successfully";
        } else {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}

//5. Confirmation 
function confirmQuery($result){
    global $connection;
    if($result){
        echo "SUCCESFUL";
       }else{
         die('QUERY FAILED' . mysqli_error($connection));
       }
}

//6. Users Online 

function usersOnline() {

    
  /*CHECKING AOUNT OF USERS ONLINE FUnctionality */

  global $connection;

  

    
    //generating an id for the the current sesion
    $session = session_id();
    //getting current time
    $time = time();
    /*the amount of time we want to mark the user
    as offline in this case, we want user to be
    offline after 60 seconds*/
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    //sql query 
    $query = "SELECT * FROM users_online WHERE session = '{$session}' ";
    //executing query
    $send_query = mysqli_query($connection, $query);
    //number of rows in db
    $count = mysqli_num_rows($send_query);


    if($count == null){
    $query = mysqli_query($connection, "INSERT into users_online(session,time) values ('{$session}', '{$time}')");
    }else{
    $query = mysqli_query($connection, "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}' ");  
    }
    $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '{$time_out}' " );
    echo $count_user = mysqli_num_rows($users_online_query);



}

// 7. Escaping strings 
function escape($string){
    global $connection;
    mysqli_real_escape_string($connection,trim($string));
}

//8. Delete Users 
function deleteUsers(){
    global $connection;
    if(isset($_GET['delete'])){

        if($_SESSION['user_role'] == "admin"){
            $user_id = mysqli_real_escape_string($connection,$_GET['delete']);
            //sql query
            $query = "DELETE FROM users WHERE user_id = {$user_id} ";
            //send query to database
            $delete_user = mysqli_query($connection,$query);
            //refreshes the page after deleting has been completed
            header("Location: users.php");
             //error handling for sent in query
            if ($delete_user === TRUE) {
                echo "Record deleted successfully";
            } else {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }


}
}

//9. 
function changeToAdmin(){
    global $connection;
    if(isset($_GET['change_to_admin'])){
        $the_user_id = $_GET['change_to_admin'];
        $admin = 'admin';
         //sql query
         $query = "UPDATE users SET user_role = '{$admin}' WHERE user_id = {$the_user_id} ";
         //send query to database
         $change_to_admin_query = mysqli_query($connection,$query);
         //refreshes the page after deleting has been completed
         header("Location: users.php");
          //error handling for sent in query
         if ($change_to_admin_query === TRUE) {
             echo "Role Reassignment Succesful";
         } else {
             die('QUERY FAILED' . mysqli_error($connection));
         }
    }
}

//10. 
function changeToSubscriber(){
    global $connection;
    if(isset($_GET['change_to_sub'])){
        $the_user_id = $_GET['change_to_sub'];
        $sub = 'subscriber';
         //sql query
         $query = "UPDATE users SET user_role = '{$sub}' WHERE user_id = {$the_user_id} ";
         //send query to database
         $change_to_sub_query = mysqli_query($connection,$query);
         //refreshes the page after deleting has been completed
         header("Location: users.php");
          //error handling for sent in query
         if ($change_to_sub_query === TRUE) {
             echo "Role Reassignment Succesful";
         } else {
             die('QUERY FAILED' . mysqli_error($connection));
         }
    }
}

//11. Add user operation 
function addUser() {

    global $connection;

    
if(isset($_POST['create_user'])){
    $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
   $user_lastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);
   $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);
   $username = mysqli_real_escape_string($connection,$_POST['username']);
   $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
   $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
 
   $crypt_md5_fmt = "$1$";
   $salt = "random_salt$";
   $hashF_and_salt = $crypt_md5_fmt . $salt;
   //hashing password
   $hashed_password = crypt($user_password,$hashF_and_salt);
 
 
   //sql query
   $query = "INSERT INTO users (user_firstname,user_lastname,user_role,username,user_email,user_password) ";
 
   $query .= 
   "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}','{$username}', '{$user_email}',
   '{$hashed_password}' )";
   
   //execute query on db
   
   $create_user_query = mysqli_query($connection, $query);
   
   
   if($create_user_query){
       echo "SUCCESFUL";
      }else{
        die('QUERY FAILED' . mysqli_error($connection));
      }
 
     echo '<br><a href="users.php">View Users</a><br><br>';
 
   
 }
}
//12. delete comment 
function deleteComment(){
   global $connection;
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
}

//13. delete comment 
function approveComment(){
   global $connection;
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
}

//14. delete comment 
function unapproveComment(){
   global $connection;
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
}
?>