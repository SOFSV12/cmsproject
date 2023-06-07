<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    <?php 
     
    if(isset($_POST['submit'])){
        
         $user_firstname = $_POST['user_firstname'];
         $user_lastname = $_POST['user_lastname'];
         $username = $_POST['username'];
         $email = $_POST['email'];
         $password= $_POST['password'];

        if(!empty($user_firstname)&& !empty($user_lastname) && !empty($username) && !empty($email) && !empty($password)){
        //preventing sql injection
        $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
        $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        // select randSalt form users table
        // $query = "SELECT randSalt FROM users";
        // //execute query
        // $select_randsalt_query = mysqli_query($connection, $query);
        // //error handling 
        // if (!$select_randsalt_query) {
        //     die("QUERY FAILED" . mysqli_error($connection));
        // }
        

        // $row = mysqli_fetch_array($select_randsalt_query);
        // $salt = $row['randSalt'];
        
        $crypt_md5_fmt = "$1$";
        $salt = "random_salt$";
        $hashF_and_salt = $crypt_md5_fmt . $salt;
        //hashing password
        $hashed_password = crypt($password,$hashF_and_salt);
       

            //sql query
            $query = "INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role)";
            $query .= "VALUES ('{$user_firstname}','{$user_lastname}','{$username}','{$email}','{$hashed_password}','subsrcriber')";
            //execute query
            $register_user_query = mysqli_query($connection, $query);
            //error handling
            if(!$register_user_query){
                die("QUERY FAILED" . mysqli_error($connection) . " ". mysqli_errno($connection));
            }
            $message = "Registration Succesful";
            header("Location: index.php");

       }else{
        $message = "Fill all Input Fields";
       }
    }else{
        $message = "";
    }
   
    ?>

    
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center" ><?php echo $message?></h6>
                        <div class="form-group">
                            <label for="user_firstname" class="sr-only">username</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">username</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Enter Lastname">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
