
<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];
      $username =  mysqli_real_escape_string($conn, $username);
      $password =  mysqli_real_escape_string($conn, $password);
      $query = "SELECT * FROM users WHERE users_name = '{$username}'";
      $select_users_query = mysqli_query($conn, $query);
      if (!$select_users_query) {
            die("Failed" . mysqli_error($conn));
      }

      while ($row = mysqli_fetch_assoc($select_users_query)) {
            $users_id = $row['users_id'];
            $users_username = $row['users_name'];
            $users_password = $row['users_password'];
            $users_firstname = $row['users_firstname'];
            $users_lastname = $row['users_lastname'];
            $users_role = $row['users_role'];
      }

      // $password = crypt($password, $users_password);
      //password_verify($password, $users_password)
      if (1 == 1) {
            $_SESSION['username'] = $users_username;
            $_SESSION['firstname'] = $users_firstname;
            $_SESSION['lastname'] = $users_lastname;
            $_SESSION['role'] = $users_role;


            echo "<h1>Successful</h1>";
            header("Location: ../admin");
      } else {
            echo "Invalid";
            header("Location: ../index.php");
      }
}


?>


