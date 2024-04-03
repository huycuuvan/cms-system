<?php
if (isset($_GET['p_id']))
    $the_post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_cate_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_img'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}

if (isset($_POST['update_post'])) {
    print_r($_POST);
    $post_user = $_POST['post_user'];
    echo $post_author;
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];


    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/ $post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row["post_img"];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title  = '{$post_title}', ";
    $query .= "post_cate_id  = '{$post_category_id}', ";
    $query .= "post_status  = '{$post_status}', ";
    $query .= "post_img  = '{$post_title}', ";
    $query .= "post_tags  = '{$post_tags}', ";
    $query .= "post_date  = now(), ";
    $query .= "post_content  = '{$post_content}', ";
    $query .= "post_author  = '{$post_author}' ";
    $query .= "WHERE post_id =  {$the_post_id}";

    $update_post = mysqli_query($conn, $query);
    confirmQuery($update_post);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$the_post_id'> View Post </a> or <a href='./posts.php'>Edit More Post</a></p>";
}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="user">Categories</label>

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

    <div class="form-group">
        <select name="post_status" id="">
            <option value='<?php echo $post_status ?>'>
                <?php echo $post_status ?>
            </option>
            <?php
            if ($post_status == 'published') {
                echo "<option value ='draft'> Draft </option>";
            } else {
                echo "<option value ='published'> Published </option>";
            }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
</div> -->

    <div class="form-group">
        <img width="100" src="../images/" <?php echo $post_image ?>alt="">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="summernote">Post content</label>
        <input type="text" class="form-control" id="summernote" name="post_content" value="<?php echo $post_content; ?>">
    </div>

    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
    </div>




</form>