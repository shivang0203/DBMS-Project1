<?php
    //Include Constants Page
    include('./config1/constants.php');

    //make changes in manage-food.php, video tming: 1:44 to 5:00
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to delete

        //1.Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        //2.Remove image if available
        if($image_name!="")
        {
            $path = "../imag/food/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check if successfully removeed or not
            if($remove == false)
            {
                //Failed to remove
                $_SESSION['upload'] = "<div class = 'error'>Failed to remove image file.</div>";
                header('location:'.SITEURL.'admin1/manage_food.php');
                //Stop process of deleting food
                die();
                //make changes in manage-food.php, video timing 17:40 
            }
        }


        //3.Remove food from Database
        $sql = "DELETE FROM `table_food` WHERE `table_food`.`id`=$id";
        //Execute query
        $res = mysqli_query($conn, $sql);
        //Check whether query executed or not


        //4.Redirect to manage food with session message
        if($res == true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class = 'success'>Food deleted successfully.</div>";
            header('location:'.SITEURL.'admin1/manage_food.php');
        }
        else
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class = 'error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin1/manage_food.php');
            //make hanges in manage-food.php, video timing: 22:20
        }

        
    }
    else{
        //Redirect to Manage Food Page
        $_SESSION['unauthorize'] = "<div class = 'error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin1/manage_food.php');
        // after including the constant page in the file, follow video from 10:45
    }


?>