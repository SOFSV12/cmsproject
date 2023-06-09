<?php
$password = "Emmanuel";
$crypt_md5_fmt = "$1$";
$salt = "random_salt$";
$hashF_and_salt = $crypt_md5_fmt . $salt;
//hashing password
$hashed_password = crypt($password,$hashF_and_salt);
echo $hashed_password;

?>

<?php
      // Check if user is logged in and is an admin
    //   if (isset($_SESSION['user_id'])) {
    //     if ($_SESSION['user_role'] == 'admin') {
    //       // Admin-only HTML elements
    //       echo '<li><a href="admin.php">Admin Dashboard</a></li>
    //       <li><a href="index.php?logout=true">Logout</a></li>';
    //     } else {
    //       // User-only HTML elements
    //       echo '<li><a href="order_history.php">Order History</a></li>
    //       <li><a href="index.php?logout=true">Logout</a></li>';
    //     }
    //     } else {
    //     // Non-logged in user HTML elements
    //     echo '<li><a href="login.php">Login</a></li>
    //     <li><a href="register.php">Register</a></li>';
    //     }
        ?>

<?php 
                    session_start();
                    if(isset($_SESSION['username'])){
                        echo "<h1>{$_SESSION['username']}<h1/>";
                        if ($_SESSION['user_role'] == 'admin') {
                            if(isset($_GET['p_id'])){
                                $post_id = $_GET['p_id']; 
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";          
                            }
                          }
                        
                    }

                    ?>                

<?php 
// if(isset($_SESSION['user_role'])){
                    //     if(isset($_GET['p_id'])){
                    //         $post_id = $_GET['p_id']; 
                    //     echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";          
                    //     }
                    // }
                    ?>