<?php include "includes/admin_header.php" ?>
<?php include "./function.php" ?>


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
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->


                        <div class="col-xs-6">


                            <?php  insert_category();?>
                            <form action="" method="post">
                            <div class="form-group">
                                <label for="cate-title">Add Category </label>
                                <input type="text" class="form-control" name="cate_title">
                                
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">

                            </div>

                            </form>

                            <?php

                            if (isset($_GET["edit"])) {
                                 $cate_id = $_GET["edit"];
                                include"includes/update_category.php";
                            }
                            ?>
          
                        </div>

                         <div class="col-xs-6"> 
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>

<?php findAll_category();?>

<?php delete_category();?>
                           
                            </tbody>
                        </table>

                         </div>
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
