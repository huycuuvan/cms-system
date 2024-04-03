<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];



    if (!empty($username) && !empty($email) && !empty($password)) {
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $password = password_hash('$password', PASSWORD_BCRYPT, array('cost' => 12));
        // $query = "SELECT randSalt FROM users";

        // $select_randsalt_query = mysqli_query($conn, $query);

        // if (!$select_randsalt_query) {
        //     die("FAILED" . mysqli_error($conn));
        // }

        // while ($row = mysqli_fetch_array($select_randsalt_query)) {
        //     $salt = $row['randSalt'];
        //     // Thực hiện xử lý với muối ở đây
        // }

        // $password = crypt($password, $salt);
        $query = "
        INSERT INTO `users`(`users_name`, `users_password`, `users_email`,  `users_role`) VALUES ('{$username}','{$password}',' {$email}','subscriber')";

        $register_user_query = mysqli_query($conn, $query);
        if (!$register_user_query) {
            die("Failed" . mysqli_error($conn));
        }

        $message = "Your Registration has been submitted";
    } else {
        $message = "Fields cannot be empty";
    }

    echo $password;
} else {
    $message = '';
}

?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6><?php echo $message; ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>