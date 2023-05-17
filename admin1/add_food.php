<?php include('partials/menu.php'); ?>
<?php include('config1/constants.php');?>


<div class="main_content">
    <div class="wrapper">
        <h1>Add Food</h1>


        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                // echo "hello";
            };
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                // echo "hello";
            };
            if (isset($_SESSION['password_not_match'])) {
                echo $_SESSION['password_not_match'];
                unset($_SESSION['password_not_match']);
                // echo "hello";
            }
        ?> 
    <br><br>
        
        <form action="" method = Post enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Food Title"/></td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td><textarea cols="30" rows="5" name="description" placeholder="Description of the food"></textarea></td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td><input type="number" name="price"/></td>
                </tr>
                
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category" >

                            <?php 
                                $sql = "SELECT * FROM `table_category` WHERE `table_category`.`active`= 'Yes'";
                                $res = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        // get the details of category
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"> <?php echo $title; ?> </option>
                                        <?php
                                    }

                                }
                                else{
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }
                            ?>

                            <!-- <option value="1">Food</option>
                            <option value="2">Snacks</option>  -->
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn_secondary">
                    </td>
                </tr>
            </table>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php 
    if(isset($_POST['submit'])){
        // get the value from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        // echo $title;

        // for radio input tag we need to check whether the button is selected or not
        if(isset($_POST['featured'])){
            // get the value form form
            $featured = $_POST['featured'];

        }
        else{
            // set the defalut value
            $featured="No";
        }
        // echo $featured;
        if(isset($_POST['active'])){
            // get the value form form
            $active = $_POST['active'];

        }
        else{
            // set the defalut value
            $active="No";
        }
        // check whether image is selected or not and set the value for image name accordingly
        // print_r($_FILES['image']);
        // die();
        if(isset($_FILES['image']['name'])){
            // upload the image
            // to upload image we need image name, source path,destination path
            $image_name = $_FILES['image']['name'];

            // upload the image only if image is selected
            if($image_name != ""){

            

                // auto raname our image
                //  get the extension of our image(eg .jpg, .jpeg, .png) eg. "food1.jpg"
                $ext = end(explode('.',$image_name));
                $image_name = "Food_Name_".rand(000,999).'.'.$ext; // "Food_Category_738.jpg"

                $source_path = $_FILES['image']['tmp_name'];
                $dest_path = "../imag/food/".$image_name;
                // finally upload the image
                $upload = move_uploaded_file($source_path,$dest_path);
                // echo $upload;
                // check whether image is uploaded or not
                // and if not uploaded we will stop the process and redirect with error
                if($upload == false){
                    $_SESSION['upload'] = "<div class =\"error\"> Failed to upload image</div>";
                    header('location:'.SITEURL.'admin1/add_food.php');
                    // stop the process
                    die();
                }
            }
        }
        else{
            // dont upload image
            $image_name = "";
        }




        // // create sql query to insertin database
        $sql2 = "INSERT INTO `table_food` (`title`,`description`,`price`,`image_name`,`category_id`, `featured` , `active`) VALUES ('$title','$description',$price ,'$image_name', $category, '$featured', '$active')";
        // echo $sql;
        $res2 = mysqli_query($conn,$sql2);
        if($res2 == TRUE){
            $_SESSION['add'] = "<div class=\"success\">Food Added Successfully</div>";
            // Redirect page
            header('location:'.SITEURL.'admin1/manage_food.php');
            // echo "done";
        }
        else{
            // failed to add category
            $_SESSION['add'] = "<div class=\"error\">Failed to add food</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'admin1/add_food.php');
        }
    }
?>