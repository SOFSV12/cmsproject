
<!-- table displaying all posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
           
            
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
           //select all posts 
           $query = "SELECT * FROM users";
           //send query to database
           $select_users = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role= $row['user_role'];
            

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";


            
            //sql query 
            /*to display the category title we check if the cat_id is the same 
            the category_id being fetched from the post table */
            // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            //  //query the database 
            //  $select_categories = mysqli_query($connection, $query);
            //  while($row = mysqli_fetch_assoc($select_categories)){
         
            //      $cat_id = $row['cat_id'];
            //      $cat_title = $row['cat_title'];
            //      echo "<td>{$cat_title}</td>";

            //  }

            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>delete</a></td>";
            echo "</tr>";
        }
            
           ?>
           <?php
// delete User Operation
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

//change user to admin Operation

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
//change user to Subscriber Operation

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
           ?>
        </tr>
    </tbody>
</table>
