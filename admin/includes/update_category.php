                  <form method="post">
                                <?php //UPDATE CATEGORY
                                if (isset($_POST["update"])) {
                                   print_r ($_POST);

                                    $cate_title_new = $_POST["cate_title"];

                                     if ($cate_title_new == "" || empty($cate_title_new)) {
                                    echo"This field should not be empty";
                                } else {

                                    $query = "UPDATE categories ";
                                        $query .= "SET cate_title =  '{$cate_title_new}'  WHERE cate_id = {$cate_id}";

                                    $update_cateory_query = mysqli_query($conn, $query);

                                    if(!$update_cateory_query){
                                        die("Failed" . mysqli_error($conn));
                                    }
                                    
                                }
                                }
                                ?>

                             <!-- Edit -->
                            <div class="form-group">
                                <label for="cate-title">Edit Category </label>

                                <?php 
                            if (isset($_GET['edit'])){
                                $cate_id_to_update = $_GET['edit'];
                               
                                $query = "SELECT * FROM categories WHERE cate_id =$cate_id_to_update ";
                                $select_id_categories_to_update_query = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($select_id_categories_to_update_query)) {
                                    $cate_id = $row['cate_id'];
                                    $cate_title = $row['cate_title'];   
                                }
                                ?>
                                <input type="text" class="form-control" name="cate_title" value = "<?php if (isset($cate_title)) {
                                    echo $cate_title;}?>" >

                       <?php } ?>
                                
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Updated">

                            </div>

                            
                            <!-- End edit -->
                            </form>