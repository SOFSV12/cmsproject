
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
deleteUsers();

//change user to admin Operation
changeToAdmin();

//change user to Subscriber Operation

changeToSubscriber();
           ?>
        </tr>
    </tbody>
</table>
