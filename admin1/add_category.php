<?php include('./partials/menu.php');?>
<?php include('./config1/constants.php'); ?>
<?php include('/Applications/XAMPP/xamppfiles/htdocs/Shivang'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Category</h1>

<br>
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
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                // echo "hello";
            };
        ?> 
    <br><br>
        
        <form action="" method = "POST" enctype="multipart/form-data" >
            <table class="tbl_30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category Title"/></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('./partials/footer.php');?>

<?php 
    if(isset($_POST['submit'])){
        // get the value from form
        $title = $_POST['title'];
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
                $image_name = "Food_Category_".rand(000,999).'.'.$ext; // "Food_Category_738.jpg"

                $source_path = $_FILES['image']['tmp_name'];
                $dest_path = "../imag/category/".$image_name;
                // finally upload the image
                $upload = move_uploaded_file($source_path,$dest_path);
                // echo $upload;
                // check whether image is uploaded or not
                // and if not uploaded we will stop the process and redirect with error
                if($upload == false){
                    $_SESSION['upload'] = "<div class =\"error\"> Failed to upload image</div>";
                    header('location:'.SITEURL.'admin1/add_category.php');
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
        $sql = "INSERT INTO `table_category` (`title`,`image_name`, `featured` , `active`) VALUES ('$title' ,'$image_name', '$featured', '$active')";
        // echo $sql;
        $res = mysqli_query($conn,$sql);
        if($res == TRUE){
            $_SESSION['add'] = "<div class=\"success\">Category Added Successfully</div>";
            // Redirect page
            header("location:".SITEURL.'admin1/manage_category.php');
            echo "done";
        }
        else{
            // failed to add category
            $_SESSION['add'] = "<div class=\"error\">Failed to add category</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'admin1/add_category.php');
        }
    }
?>