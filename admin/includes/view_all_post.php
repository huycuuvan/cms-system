<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_publish_status = mysqli_query($conn, $query);
                confirmQuery($update_to_publish_status);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_draft_status = mysqli_query($conn, $query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $update_to_delete_status = mysqli_query($conn, $query);
                confirmQuery($update_to_delete_status);
                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                $select_posts_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_cate_id = $row['post_cate_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_cate_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_img'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_content = $row['post_content'];
                }
                $query = "INSERT INTO posts (post_cate_id, post_title, post_author,post_date,post_img,post_content,post_tags,post_status)";
                $query .= "VALUE({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                $copy_query = mysqli_query($conn, $query);
                break;
        }
    }
}
?>
<form action="" method="post" class="mb-2">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer  " class="col-xs-4 ">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" class="btn btn-success" name="submit" value="Apply">
            <a href="./posts.php?source=add_post" class="btn btn-primary">Add new</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Users</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>


            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_posts_query)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_cate_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_img'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
                echo "<tr>";
            ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id;  ?>'></td>
            <?php
                echo "<td>$post_id</td>";

                if (!empty($post_author)) {

                    echo "<td>$post_author</td>";
                } elseif (!empty($post_user)) {
                    echo "<td>$post_user</td>";
                }



                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE cate_id =$post_category_id ";
                $select_id_categories_to_update_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_id_categories_to_update_query)) {
                    $cate_id = $row['cate_id'];
                    $cate_title = $row['cate_title'];
                    echo "<td> $cate_title</td>";
                }
                echo "<td> $post_status</td>";
                echo "<td> <img width=100 src = '../images/$post_image' > </td>";
                echo "<td>$post_tags</td>";
                $comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($conn, $comment_query);
                $row = mysqli_fetch_array($send_comment_query);
                $comment_id = isset($row['comment_id']);

                $count_comments = mysqli_num_rows($send_comment_query);
                echo "<td><a href='post_comment.php?id=$post_id'>$count_comments</a></td>";
                echo "<td> $post_date</td>";
                echo "<td> <a href='../post.php?p_id={$post_id}'> View Post</a></td>";
                echo "<td> <a href='posts.php?source=edit_post&p_id={$post_id}'> Edit</a></td>";
                echo "<td> <a onClick=\"javascript: return confirm('Are you sure want to delete ?'); \" href='posts.php?delete={$post_id}'> Delete</a></td>";
                echo "<td> <a href='posts.php?reset={$post_id}'> {$post_views_count}</a></td>";
                echo "</tr>";
            }

            delete_post();
            if (isset($_GET['reset'])) {
                $the_post_id = $_GET['reset'];
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($conn, $_GET['reset']) . "";
                $reset_query = mysqli_query($conn, $query);
                header("Location: posts.php");
            }
            ?>


        </tbody>
    </table>
</form>