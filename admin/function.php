<?php

include "../includes/db.php";

function users_online()
{

    if (isset($_GET['onlineusers'])) {

        global $conn;
        if (!$conn) {
            include "../includes/db.php";
        }
        session_start();
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($conn, $query);
        $count = mysqli_num_rows($send_query);
        if ($count == NULL) {
            mysqli_query($conn, "INSERT INTO users_online(session, time) VALUE ('$session', '$time')");
        } else {
            mysqli_query($conn, "UPDATE users_online SET time='$time' WHERE session = '$session'");
        }

        $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);
    }
}

users_online();
function confirmQuery($result)
{
    global $conn;
    if (!$result) {
        die("Failed" . mysqli_error($conn));
    }
}
function insert_category()
{
    global $conn;
    if (isset($_POST["submit"])) {

        $cate_title =  $_POST["cate_title"];

        if ($cate_title == "" || empty($cate_title)) {
            echo "This field should not be empty";
        } else {

            $query = "INSERT INTO categories(cate_title) ";
            $query .= "VALUE ('{$cate_title}') ";

            $creat_cateory_query = mysqli_query($conn, $query);

            if (!$creat_cateory_query) {
                die("Failed" . mysqli_error($conn));
            }
        }
    }
}

function findAll_category()
{
    global $conn;
    $query = "SELECT * FROM categories";
    $select_categories_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_categories_query)) {
        $cate_id = $row['cate_id'];
        $cate_title = $row['cate_title'];
        echo "<tr>";
        echo "<td>{$cate_id}</td>";
        echo "<td>{$cate_title}</td>";
        echo "<td><a href='categories.php?delete={$cate_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cate_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_category()
{
    global $conn;
    if (isset($_GET['delete'])) {
        $the_cate_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cate_id = {$the_cate_id} ";

        $delete_query = mysqli_query($conn, $query);
        header("Location: categories.php");
    }
}

function delete_post()
{
    global $conn;
    if (isset($_GET["delete"])) {
        $post_id = $_GET["delete"];
        $query = "DELETE FROM posts WHERE post_id = {$post_id} ";

        $delete_query = mysqli_query($conn, $query);
        header("Location: posts.php");
    }
}
function delete_comment()
{
    global $conn;
    if (isset($_GET["delete"])) {
        $comment_id = $_GET["delete"];
        $query = "DELETE FROM posts WHERE comment_id = {$comment_id} ";

        $delete_query = mysqli_query($conn, $query);
        header("Location: comments.php");
    }
}
