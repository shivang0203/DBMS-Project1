
<?php 
    include('../Shivang/cs');
    include('./config1/constants.php');
    //  get the id of admin to be deleted
    $id = $_GET['id'];

    // create sql query to delete admin
    $sql = "DELETE FROM `table_admin` WHERE `table_admin`.`id` = $id"; 

    $res = mysqli_query($conn,$sql);

    if($res == TRUE){
        // echo "Admin Deleted";
        // create session variable to display message
        $_SESSION['delete'] = "<div class=\"success\"> Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'/admin1/manage_admin.php');
    }
    else{
        // echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class=\"error\">Failed to delete admin</div>";
        header('location:'.SITEURL.'/admin1/manage_admin.php');
    }

    // redirect to page manage admin
?>