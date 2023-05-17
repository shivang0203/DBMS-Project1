<?php include('partials_front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql1 = "SELECT * FROM `table_food` WHERE `table_food`.`active` ='Yes' ";
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./partials_front/footer.php');?>