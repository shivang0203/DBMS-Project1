<?php include('partials/menu.php') ?>
<!-- Main content section starts -->
<div class="main_content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />
        <a href="<?php echo SITEURL; ?>admin1/add_food.php" class="btn_primary">Add Food</a>
        <br /><br /><br />
        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                // echo "hello";
            };
            if (isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
                // echo "hello";
            };
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                // echo "hello";
            };
            if (isset($_SESSION['unauthorize'])){
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
                // echo "hello";
            };
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                // echo "hello";
            };
        ?>

        <table class="tbl_full">
        <tr>
                <th>S.No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM `table_food`";
                $res = mysqli_query($conn, $sql);

                

                if ($res == TRUE) {
                    // Count the rows to check wheter we have data in database or not
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    // check the number of rows
                    if ($count > 0) {
                        // We have data in data base
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // using while loop to get all the data from database
    
                            // get individual data
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
    
                            // display the values in our table
                ?>
    
                            <!-- Html part -->
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>

                                <td>
                                    <?php 
                                        if($image_name != ""){
                                            // display image
                                            ?>
                                            <img src="<?php echo SITEURL;?>/imag/food/<?php echo $image_name;?>" width = "150px ">
                                            <?php
                                        }
                                        else{
                                            // display the message
                                            echo " <div class = \"error\">Image not added</div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $featured; ?> </td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>/admin1/update-food.php?id=<?php echo $id; ?>" class="btn_secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>/admin1/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Food</a>
                                </td>
                            </tr>
    
    
                <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>
                        <?php
                        // we have no data in database
                    }
                }
                ?>
        </table>

    </div>
</div>
<!-- main content section ends -->

<?php include('partials/footer.php') ?>