<?php include('partials/menu.php'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Admin</h1>


        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM `table_admin` where `table_admin`.`id` = $id"; 

            $res = mysqli_query($conn,$sql);

            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count==1){
                    // echo "Admin Available"; 
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    header('location:'.SITEURL.'/admin1/manage_admin.php');
                }
            }
            // else{
            //     // echo "Failed to delete admin";
            //     // $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
            //     // header('location:'.SITEURL.'/admin1/manage_admin.php');
            // }
        ?> 
    <br><br>
        
        <form action="" method = POST >
            <table class="tbl_30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"/></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <!-- <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr> -->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php');?>
<?php 
    if($_POST['submit']){
        // echo "Button CLicked";
        // get all the values from form to update
        echo $id = $_POST['id'];
        echo $full_name = $_POST['full_name'];
        echo $username = $_POST['username'];

        $sql = "UPDATE `table_admin` SET
        full_name = '$full_name',
        username = '$username'
        where id = '$id'
        ";

        $res= mysqli_query($conn,$sql);

        if($res ==TRUE){
            $_SESSION['update'] = "<div class=\"success\">Admin Updated Successfully</div>";
            header("location:".SITEURL.'/admin1/manage_admin.php');
        }
        else{
            $_SESSION['update'] = "<div class=\"error\">Failed to Update Admin</div>";
            header("location:".SITEURL.'/admin1/manage_admin.php');
        }
    }
?>

