<?php include('partials_front/menu.php');?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
            // echo "hello";
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sql = "SELECT * FROM `table_category` WHERE `table_category`.`active` ='Yes' AND `table_category`.`featured` ='Yes' LIMIT 3";
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
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 
                $sql1 = "SELECT * FROM `table_food` WHERE `table_food`.`active` ='Yes' AND `table_food`.`featured` ='Yes' LIMIT 6";
                $res1 = mysqli_query($conn, $sql1); 
                $count1 = mysqli_num_rows($res1);
                if ($count1 > 0) {
                    // We have data in data base
                    while ($rows = mysqli_fetch_assoc($res1)) {
                        // using while loop to get all the data from database

                        // get individual data
                        $id1 = $rows['id'];
                        $title1 = $rows['title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name1 = $rows['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php 
                                if($image_name1 == ""){
                                    echo "<div class = \"error\">Image Not Available.</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL;?>imag/food/<?php echo $image_name1; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                    
                                }

                            ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title1;?></h4>
                                <p class="food-price">Rs. <?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <form action="order.php" method="post">
                                <input type="hidden" name="food_id" value="<?php echo $id1; ?>">
                                <input type="submit" class="btn btn-primary" value="Add To Cart"></input>
                                </form>
                            </div>
                        </div>


                        <?php
                    }
                }
                else{
                    echo "<div class = \"error\">Food Not Found.</div>";
                }
            
            ?>
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    

    <?php include('./partials_front/footer.php');?>