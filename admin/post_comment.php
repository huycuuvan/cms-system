<?php include "includes/admin_header.php" ?>
<?php include "./function.php" ?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                global $conn;
                                $query = "SELECT * FROM comments WHERE comment_post_id=" . mysqli_real_escape_string($conn, $_GET['id']) . "";
                                $select_comment_query = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($select_comment_query)) {
                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_content = $row['comment_content'];
                                    $comment_email = $row['comment_email'];
                                    $comment_status = $row['comment_status'];

                                    $comment_date = $row['comment_date'];
                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_content</td>";

                                    //    $query = "SELECT * FROM categories WHERE cate_id =$post_category_id ";
                                    //    $select_id_categories_to_update_query = mysqli_query($conn, $query);
                                    //  while ($row = mysqli_fetch_assoc($select_id_categories_to_update_query)) {
                                    //      $cate_id = $row['cate_id'];
                                    //      $cate_title = $row['cate_title'];
                                    //      echo "<td> $cate_title</td>";
                                    //  }
                                    echo "<td> $comment_email</td>";

                                    echo "<td>$comment_status</td>";

                                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                    $select_post_id_query = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                        $post_id = $row["post_id"];
                                        $post_title = $row["post_title"];

                                        echo "<td><a href = '../post.php?p_id=$post_id'> $post_title</a></td>";
                                    }

                                    echo "<td> $comment_date</td>";
                                    echo "<td> <a href='post_comment.php?approve=$comment_id&id=" . $_GET['id'] . "'> Approve</a></td>";
                                    echo "<td> <a href='post_comment.php?unapprove=$comment_id&id=" . $_GET['id'] . "'> Unapprove</a></td>";
                                    echo "<td> <a href='post_comment.php?delete=$comment_id&id=" . $_GET['id'] . "' class= 'notification''> Delete</a></td>";
                                    echo "</tr>";
                                }



                                ?>


                            </tbody>
                        </table>

                        <?php
                        if (isset($_GET["approve"])) {
                            $the_comment_id = $_GET["approve"];
                            $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = $the_comment_id ";

                            $approve_comment_query = mysqli_query($conn, $query);
                            header("Location: post_comment.php?id=" . $_GET['id'] . "");
                        }

                        if (isset($_GET["unapprove"])) {
                            $the_comment_id = $_GET["unapprove"];
                            $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = $the_comment_id ";

                            $unapprove_comment_query = mysqli_query($conn, $query);
                            header("Location: post_comment.php?id=" . $_GET['id'] . "");
                        }


                        if (isset($_GET["delete"])) {
                            $comment_id = $_GET["delete"];
                            $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";

                            $delete_query = mysqli_query($conn, $query);
                            header("Location: post_comment.php?id=" . $_GET['id'] . "");
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "./includes/admin_footer.php" ?>

</body>

</html>