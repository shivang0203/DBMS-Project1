<?php include('partials/menu.php') ?>
<?php include('./config1/constants.php'); ?>
<!-- Main content section starts -->
<div class="main_content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />

        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                // echo "hello";
            };
            if (isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
                // echo "hello";
            };
            if (isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
                // echo "hello";
            };
            if (isset($_SESSION['no_category_found'])){
                echo $_SESSION['no_category_found'];
                unset($_SESSION['no_category_found']);
                // echo "hello";
            };
            if (isset($_SESSION['category_updated'])){
                echo $_SESSION['category_updated'];
                unset($_SESSION['category_updated']);
                // echo "hello";
            };
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                // echo "hello";
            };
            if (isset($_SESSION['failed_remove'])){
                echo $_SESSION['failed_remove'];
                unset($_SESSION['failed_remove']);
                // echo "hello";
            };

        ?> 
        <br><br>
        <a href="<?php echo SITEURL;?>admin1/add_category.php" class="btn_primary">Add Category</a>
        <br /><br />

        <table class="tbl_full">
            <tr>
                <th>S.No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM `table_category`";
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
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
    
                            // display the values in our table
                ?>
    
                            <!-- Html part -->
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 
                                        if($image_name != ""){
                                            // display image
                                            ?>
                                            <img src="<?php echo SITEURL;?>/imag/category/<?php echo $image_name;?>" width = "150px ">
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
                                    <!-- <a href="<?php echo SITEURL; ?>/admin1/update_password.php?id=<?php echo $id; ?>" class="btn_primary">Change Password</a> -->
                                    <a href="<?php echo SITEURL; ?>/admin1/update_category.php?id=<?php echo $id; ?>" class="btn_secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>/admin1/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Category</a>
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
            <!-- <tr>
                <td>1.</td>
                <td>Shivang </td>
                <td>shivang0203</td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn_secondary">Update Category</a>
                    <a href="#" class="btn_danger">Delete Category</a>
                </td>
            </tr> -->

            
        </table>

    </div>
</div>
<!-- main content section ends -->

<?php include('partials/footer.php') ?>