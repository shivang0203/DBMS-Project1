<?php include('partials/menu.php'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Change Password</h1>


        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }

            // 
            
            // $sql = "SELECT * FROM `table_admin`"; 

            // $res = mysqli_query($conn,$sql);

            // if($res == TRUE){
            //     $count = mysqli_num_rows($res);
            //     if($count>=1){
            //         // echo "Admin Available"; 
            //         $row = mysqli_fetch_assoc($res);
            //         $full_name = $row['full_name'];
            //         $username = $row['username'];
            //     }
            //     else{
            //         header('location:'.SITEURL.'/admin1/manage_admin.php');
            //     }
            // }
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
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder = "Current Password" /></td>
                </tr>

                <tr>
                    <td>New password</td>
                    <td>
                        <input type="password" name="new_password" placeholder = "New Password" >
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>
<?php 
    if(isset($_POST['submit'])){
        // echo "Button CLicked";
        // get all the values from form to update
         $id = $_POST['id'];
         $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM `table_admin` where id = $id  AND password = '$current_password'";

        $res= mysqli_query($conn,$sql);

        if($res ==TRUE){
            $count= mysqli_num_rows($res);
            if($count==1){
                // echo "user found";
                if($new_password == $confirm_password){
                    $sql2 = "UPDATE `table_admin` SET
                    password = '$new_password'
                    WHERE id = '$id'";

                    $res2 = mysqli_query($conn,$sql2);
                    if($res2 == TRUE){
                        $_SESSION['change_password'] = "<div class=\"success\">Password Changed Successfully</div>";
                        header("location:".SITEURL.'/admin1/manage_admin.php');
                    }
                    else{
                        $_SESSION['change_password'] = "<div class=\"error\">Failed to change Password.</div>";
                        header("location:".SITEURL.'/admin1/manage_admin.php');

                    }
                }
                else{
                    $_SESSION['password_not_match'] = "<div class=\"error\">New Password and Confirm Password does not match.</div>";
                    header("location:".SITEURL.'/admin1/manage_admin.php');
                }
            }
            else{
                $_SESSION['user_not_found'] = "<div class=\"error\">User not found</div>";
                header("location:".SITEURL.'/admin1/manage_admin.php');

            }
        }
        // else{
        //     $_SESSION['update'] = "Failed to Update Admin";
        //     header("location:".SITEURL.'/admin1/manage_admin.php');
        // }
    }
?>
