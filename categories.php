<?php include('./partials_front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql = "SELECT * FROM `table_category` WHERE `table_category`.`active` ='Yes' ";
                $res = mysqli_query($conn, $sql); 
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    // We have data in data base
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // using while loop to get all the data from database

                        // get individual data
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name == ""){
                                    echo "<div class = \"error\">Image Not Available.</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL;?>imag/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                    
                                }

                            ?>
                            

                            <h3 class="float-text text-white text_center"><?php echo $title; ?></h3>
                        </div>
                        </a>


                        <?php
                    }
                }
                else{
                    echo "<div class = \"error\">No Category added.</div>";
                }
            
            ?>
            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <?php include('./partials_front/footer.php');?>