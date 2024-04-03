<?php include "includes/admin_header.php" ?>
<?php include "./function.php" ?>

<?php 
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE users_name = '{$username}'";
    $select_user_profile_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_user_profile_query)){

        $users_id = $row['users_id'];
        $users_name = $row['users_name'];
        $users_password = $row['users_password'];
        $users_firstname = $row['users_firstname'];
        $users_lastname = $row['users_lastname'];
        $users_email = $row['users_email'];
        $users_img = $row['users_img'];
        $users_role = $row['users_role'];
    }
}

?>


<?php 

if(isset($_POST['edit_user'])) {
    global $conn;
    
   $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/ $post_image");


 $query = "UPDATE users SET ";
    $query .= "users_firstname  = '{$user_firstname}', ";
    $query .= "users_lastname = '{$user_lastname}', ";
    $query .= "users_role  = '{$user_role}', ";
    $query .= "users_email  = '{$user_email}', ";
    $query .= "users_password  = '{$user_password}' ";
    $query .= "WHERE users_name=  '{$username}'" ;
    $update_users = mysqli_query($conn, $query);
    confirmQuery($update_users);
    
    
}



?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "./includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>

 
    



<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">First Name</label>
    <input type="text" value="<?php echo $users_firstname; ?>" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" value="<?php echo $users_lastname; ?>"  class="form-control" name="user_lastname">
</div>

<div class="form-group">
    <select class="form-select" name="user_role" id="post_category">

        <option value="subscribers"><?php echo $users_role?></option>
    <?php 
    if($users_role == 'admin'){

        echo" <option value='subscribers'>subscribers</option>";
    } else {
        echo" <<option value='admin'>admin</option>";

    }
    ?>

    </select>

    
</div>

<!-- 
<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">UserName</label>
    <input type="text" value="<?php echo $users_name; ?>" class="form-control" name="user_name">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
    <input type="text" value="<?php echo $users_email; ?>" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="post_content">Password</label>
    <input type="password" value="<?php echo $users_password; ?>" class="form-control" name="user_password">
</div>

<div class="form-group">
   
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
</div>




</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "./includes/admin_footer.php"?>

</body>

</html>
