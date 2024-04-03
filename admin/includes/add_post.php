<?php
if (isset($_POST['creat_post'])) {
    global $conn;
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // $post_comment_count = 4;


    move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO posts (post_cate_id, post_title, post_user,post_date,post_img,post_content,post_tags,post_status)";
    $query .= "VALUE({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $insert_post_query = mysqli_query($conn, $query);
    if (!$insert_post_query) {
        die("Failed" . mysqli_error($conn));
    }
    $the_post_id = mysqli_insert_id($conn);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id=$the_post_id'> View Post </a> or <a href='./posts.php?source=add_post'>Add More Post</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Categories</label>

        <select class="form-select" name="post_category" id="post_category">

            <?php


            $query = "SELECT * FROM categories ";
            $select_id_categories = mysqli_query($conn, $query);
            confirmQuery($select_id_categories);
            while ($row = mysqli_fetch_assoc($select_id_categories)) {
                $cate_id = $row['cate_id'];
                $cate_title = $row['cate_title'];

                echo "<option value ='{$cate_id}'> $cate_title </option>";
            }

            ?>
        </select>


    </div>



    <div class="form-group">
        <label for="user">Users</label>

        <select class="form-select" name="post_user" id="">

            <?php


            $query = "SELECT * FROM users ";
            $select_id_user = mysqli_query($conn, $query);
            confirmQuery($select_id_user);
            while ($row = mysqli_fetch_assoc($select_id_user)) {
                $users_id = $row['users_id'];
                $users_name = $row['users_name'];

                echo "<option value ='{$users_name}'> $users_name </option>";
            }

            ?>
        </select>


    </div>







    <!-- 
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->

    <div class="form-group">

        <select name="post_status" id="">
            <option value="Draft">Post status</option>
            <option value="published">Publish</option>
            <option value="Draft">Draft</option>
        </select>

    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Post content</label>
        <input type="text" class="form-control" name="post_content" id="summernote">
    </div>

    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="creat_post" value="Publish Post">
    </div>




</form>