<?php 
if(isset($_POST['add_user'])) {
    global $conn;
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/ $post_image");


    $query = "INSERT INTO `users`( `users_name`, `users_password`, `users_firstname`, `users_lastname`, `users_email`,  `users_role`) VALUES ('$user_name','$user_password','$user_firstname',' $user_lastname','$user_email ','$user_role')";

    $insert_users_query = mysqli_query($conn, $query);
    if (!$insert_users_query) {
        die("Failed". mysqli_error($conn));
    }
    
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
    <select class="form-select" name="user_role" id="post_category">

<option value="subscribers">Select options</option>
<option value="admin">admin</option>
<option value="subscribers">subscribers</option>
    </select>

    
</div>

<!-- 
<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">UserName</label>
    <input type="text" class="form-control" name="user_name">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
    <input type="text" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="post_content">Password</label>
    <input type="text" class="form-control" name="user_password">
</div>

<div class="form-group">
   
    <input class="btn btn-primary" type="submit" name="add_user" value="Add user">
</div>




</form>