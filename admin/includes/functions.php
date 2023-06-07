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
    return $count_user = mysqli_num_rows($users_online_query);



}

// 7. Escaping strings 
function escape($string){
    global $connection;
    mysqli_real_escape_string($connection,trim($string));
}

?>