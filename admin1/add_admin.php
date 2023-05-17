<?php include('partials/menu.php'); ?>
<?php include('./config1/constants.php');?> 
<div class="main_content">
    <div class="wrapper">
        <h1>Add Admin</h1>


        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                // echo "hello";
            };
            if (isset($_SESSION['password_not_match'])) {
                echo $_SESSION['password_not_match'];
                unset($_SESSION['password_not_match']);
                // echo "hello";
            }
        ?> 
    <br><br>
        
        <form action="" method = Post >
            <table class="tbl_30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"/></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php');?>

<?php
    // Process the value form and save it in Database
    // check whether the button is clicked or not

    if(isset($_POST['submit'])){
        // Butoon clicked
        // echo" Button Clicked";

        // Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // password encryption with md5

        // sql query to save the data in data base;
        
        // --     full_name = '$full_name',
        // --     username = '$username',
        // --     password = '$password'
        // -- ";
        // echo $sql;
        // execute query and save data in database
        // $conn = mysqli_connect('localhost', 'root','ssss') or die("Could not connect"); // datadbase connetion
        // $db_select = mysqli_select_db($conn,'Shivang') or die("no database"); // database selection
        // echo $conn;
        // $res = mysqli_query($conn,$sql);
        // // check whether the data is inserted or not
        // $LOCALHOST="localhost";
        // $DB_USERNAME="root";
        // $DB_PASSWORD="";
        // $DB_NAME="Shivang";
        // $conn = mysqli_connect($LOCALHOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME); 
        // if(!$conn){
        //     die("Sorry we failed to connect".mysqli_connect_error());
        // }
        // else{
        //     echo "The Connection was successful";
        // }
        
        $sql = "INSERT INTO `table_admin` (`full_name`, `username` , `password`) VALUES ('$full_name' , '$username', '$password');";
        $res = mysqli_query($conn,$sql);
        if($res){
            // Data insterted 
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class=\"success\">Admin Added Successfully</div>";
            // Redirect page
            header("location:".SITEURL.'admin1/manage_admin.php');
        }
        else{
            // failed to insert data
            $_SESSION['add'] = "<div class=\"error\">Failed to add admin</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'admin1/add_admin.php');
        }

    }
    

?>