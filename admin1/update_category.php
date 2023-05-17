<?php include('partials/menu.php'); ?>
<div class="main_content">
    <div class="wrapper">
        <h1>Update Category</h1>


        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                // create sql query to get all other details
                $sql = "SELECT * FROM `table_category` where id = $id ";
                $res= mysqli_query($conn,$sql);
                // count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);
                if($count == 1){
                    // get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no_category_found'] = "<div class=\"error\">Category not found.</div>";
                    header("location:".SITEURL.'/admin1/manage_category.php');
                }
            }
            else{
                header("location:".SITEURL.'/admin1/manage_category.php');
            }
        ?> 
    <br><br>
        
        <form action="" method = POST enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title</td>
                    <td><input type="title" name="title" value="<?php echo $title; ?>"/></td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <!-- image will be displayed here -->
                        <?php 
                            if($current_image != ""){
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>/imag/category/<?php echo $current_image;?>" width = "150px ">
                                <?php
                            }
                            else{
                                // dis[play the message
                                echo "<div class=\"error\">Image not added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name = "id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit'])){
                // echo "clicked";
                // get all the values form our form
                $title = $_POST['title'];
                // $current_image = $_POST['image_name'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image if selected
                // check whether the image is selected or not
                // if(isset($_FILES['image']['name'])){
                //     // get the image details
                //     $image_name=$_FILES['image']['name'];
                //     if($image_name != ""){


                //         $ext = end(explode('.',$image_name));
                //         $image_name = "Food_Category_".rand(000,999).'.'.$ext; // "Food_Category_738.jpg"

                //         $source_path = $_FILES['image']['tmp_name'];
                //         $dest_path = "../imag/category/".$image_name;
                //         // finally upload the image
                //         $upload = move_uploaded_file($source_path,$dest_path);
                //         // echo $upload;
                //         // check whether image is uploaded or not
                //         // and if not uploaded we will stop the process and redirect with error
                //         if($upload == false){
                //             $_SESSION['upload'] = "<div class =\"error\"> Failed to upload image</div>";
                //             header('location:'.SITEURL.'admin1/manage_category.php');
                //             // stop the process
                //             die();
                //         }

                //         // remove our current image
                //         if($current_image != ""){
                //             $remove_path = "../imag/category/".$current_image;
                //             $remove = unlink($remove_path);

                //             // check whether the image is removed or not

                //             // if failed to remove display message and stop the process
                //             if($remove == false){
                //                 $_SESSION['failed_remove'] = "<div class =\"error\"> Failed to remove image</div>";
                //                 header('location:'.SITEURL.'admin1/manage_category.php');
                //                 die();
                //             }
                //         }
                //         // else{
                //         //     $image_name = $current_image;
                //         // }
                        
                //     }
                //     else{
                //         $image_name = $current_image;
                //     }
                // }
                // else{
                //     $image_name = $current_image;
                // }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name']; 

                    if($image_name!="")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_category-".rand(0000,9999).'.'.$ext;

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../imag/category".$image_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            header('location:'.SITEURL.'admin1/manage_category.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = "../imag/category/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin1/manage_category.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                // update the database
                // $sql2 = "UPDATE `table_category` SET
                //     title = '$title',
                //     image_name = '$image_name',
                //     featured = '$featured',
                //     active = '$active'
                //     where id = $id
                // ";


                $sql3 = "UPDATE `table_category` SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                $res2= mysqli_query($conn,$sql3);

                if($res2 == true){
                    $_SESSION['category_updated'] = "<div class=\"success\">Category Updated Successfully.</div>";
                    header("location:".SITEURL.'/admin1/manage_category.php');
                }
                else{
                    $_SESSION['category_updated'] = "<div class=\"error\">failed to update category.</div>";
                    header("location:".SITEURL.'/admin1/manage_category.php');
                }


                // redirect to manage category with database
            }



        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>