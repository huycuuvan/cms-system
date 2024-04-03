 <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>FirsName</th>
                                    <th>LastName</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                

 <?php
 global $conn;
  $query = "SELECT * FROM users";
 $select_users_query = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($select_users_query)) {
 $users_id = $row['users_id'];
  $users_name = $row['users_name'];
  $users_password = $row['users_password'];
  $users_firstname = $row['users_firstname'];
  $users_lastname = $row['users_lastname'];
  $users_email = $row['users_email'];
  $users_img = $row['users_img'];
  $users_role = $row['users_role'];
 
 
echo "<tr>";
     echo "<td>$users_id</td>";
     echo "<td>$users_name</td>";
     echo "<td>$users_firstname</td>";

    //    $query = "SELECT * FROM categories WHERE cate_id =$post_category_id ";
    //    $select_id_categories_to_update_query = mysqli_query($conn, $query);
    //  while ($row = mysqli_fetch_assoc($select_id_categories_to_update_query)) {
    //      $cate_id = $row['cate_id'];
    //      $cate_title = $row['cate_title'];
    //      echo "<td> $cate_title</td>";
    //  }
     echo "<td> $users_lastname</td>";
    
     echo "<td>$users_email</td>";
     echo "<td>$users_role</td>";

    //  $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    //  $select_post_id_query = mysqli_query($conn, $query);
    //  while ($row = mysqli_fetch_assoc($select_post_id_query)) {
    // $post_id = $row["post_id"];
    // $post_title = $row["post_title"];
        
    //      echo "<td><a href = '../post.php?p_id=$post_id'> $post_title</a></td>";
    // }
     
    
     echo "<td> <a href='users.php?change_to_admin=$users_id'> Admin</a></td>";
     echo "<td> <a href='users.php?change_to_subscribers=$users_id'> Subscribers</a></td>";
     echo "<td> <a href='users.php?source=edit_user&edit_user=$users_id'> Edit</a></td>";
     echo "<td> <a href='users.php?delete=$users_id'> Delete</a></td>";
 echo "</tr>";
    }


 
 ?>
                             
                                
                            </tbody>
                        </table>

                        <?php
                    if (isset($_GET["change_to_admin"])) {
                            $the_user_id = $_GET["change_to_admin"];
                            $query = "UPDATE users SET users_role = 'admin' WHERE users_id = $the_user_id ";

                            $change_to_admin_query = mysqli_query($conn, $query);
                            header("Location: users.php");
                        }

                    if (isset($_GET["change_to_subscribers"])) {
                            $the_user_id = $_GET["change_to_subscribers"];
                            $query = "UPDATE users SET users_role = 'subscribers' WHERE users_id = $the_user_id ";

                            $unapprove_comment_query = mysqli_query($conn, $query);
                            header("Location: users.php");
                        }


                        if (isset($_GET["delete"])) {
                            $users_id = $_GET["delete"];
                            $query = "DELETE FROM users WHERE users_id = {$users_id} ";

                            $delete_query = mysqli_query($conn, $query);
                            header("Location: users.php");
                        }
                        ?>