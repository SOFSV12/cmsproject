
<!-- table displaying all posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Respone to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
           //select all posts 
           $query = "SELECT * FROM comments";
           //send query to database
           $select_comments = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id= $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
           

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            //sql query
            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
            //executing query
            $select_post_id_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                
            }

            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>delete</a></td>";
            echo "</tr>";
        }
            
           ?>
           <?php




// delete comment operation
deleteComment();
// unapprove comment operation
approveComment();
// approve comment operation
unapproveComment();
           ?>
        </tr>
    </tbody>
</table>
