<?php 
    include('../Shivang/cs');
    include('./config1/constants.php');
    //  get the id of admin to be deleted
   
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        // remove the physical image file if available
        if($image_name != ""){
            $path = "../imag/category/".$image_name;
            // remove the image
            $remove = unlink($path);
            // if failed to remove image display error and stop the process to display data from database
            if($remove == false){
                // set the session message 
                $_SESSION['remove'] = "<div class=\"error\">Failed to delete category image.</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'/admin1/manage_category.php');
                // stop the process
                die();

            }
        }

        // delete data from database

        // redirect to manage category page
        $sql = "DELETE FROM `table_category` WHERE `table_category`.`id` = $id"; 

        $res = mysqli_query($conn,$sql);
        if($res == true){
            $_SESSION['delete'] = "<div class=\"success\"> Category Deleted Successfully</div>";
            header('location:'.SITEURL.'/admin1/manage_category.php');
        }
        else{
            $_SESSION['delete'] = "<div class=\"error\">Failed to delete category</div>";
            header('location:'.SITEURL.'/admin1/manage_category.php');
        }
        
    }
    else{
        header('location:'.SITEURL.'/admin1/manage_category.php');
    }

    // create sql query to delete admin
    
?>