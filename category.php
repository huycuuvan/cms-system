<?php include "includes/db.php"?>
<?php include "includes/header.php"?>



<body>

    <!-- Navigation -->
   <?php include"includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


            <?php

            if(isset($_GET['category'])){
                $cate_id = $_GET['category'];
                
            }
            $query = "SELECT * FROM posts WHERE post_cate_id = $cate_id ";
            $select_all_post_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($select_all_post_query)) {
                $post_id = $row['post_id'];
                
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_img = $row['post_img'];
                               $post_content = substr($row['post_content'],0,100);

                
                echo "";
                ?>





                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>










     <?php   } ?>


                <!-- Second Blog Post -->
            

                <!-- Third Blog Post -->
               

                <!-- Pager -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"?>

        </div>
        </div>
        <!-- /.row -->

        <hr>

       <?php
        include"includes/footer.php";
       ?>
</body>

</html>
