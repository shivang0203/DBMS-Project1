<?php include('./config1/constants.php'); ?>
<?php include('partials_front/menu.php');?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-
scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="style.css"> -->
    <script>
        function validateForm() {
            var username = document.forms["signup"]["username"].value;
            var email = document.forms["signup"]["email"].value;
            var password = document.forms["signup"]["password"].value;

            var confirmPassword = document.forms["signup"]["confirm-password"].value;

                var phone = document.forms["signup"]["phone"].value;

                if (username == "" || email == "" || password == "" ||
                    confirmPassword == "") {
                    alert("All fields must be filled out");
                    return false;
                }
                var emailRegex = /\S+@\S+\.\S+/;
                if (!emailRegex.test(email)) {
                    alert("Please enter a valid email address");
                    return false;
                }
                var phoneRegex = /^\d{10}$/;
                if (!phoneRegex.test(phone)) {
                    alert("Please enter a valid 10-digit phone number");
                    return false;
                }
                if (password != confirmPassword) {
                    alert("Passwords do not match");
                    return false;
                }
            }
    </script>
<!-- </head> -->
<!-- 
<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="Annapurna.png" alt=""></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i> -->
                <!-- <ul> -->
                <!-- <li><a href="./home.php">HOME</a></li>
                    <li><a href="./about.php">ABOUT</a></li>
                    <li><a href="./donate.php">DONATE</a></li>
                    <li><a href="./request.php">REQUEST</a></li>
                    <li><a href="./volunteer.php">VOLUNTEER</a></li>
                    <li><a href="./contact.php">CONTACT US</a></li>
                    <li><a href="./login.php">SIGNUP</a></li>
                    <li><a href="./logout.php">LOGOUT</a></li>
                </ul> -->
            <!-- </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav> -->
        <div class="login">
            <form name="signup" method="POST" action="login.php" onsubmit="return validateForm()" style="margin-left: 300px; margin-right: 300px; border:1px solid #ccc; border-radius: 10px; background-color: rgba(110, 125, 129, 0.235); box-shadow: 10px whitesmoke">
                <div style="margin: 20px; margin-right: 40px;" class="container">
                    <h1 style="color: white">Sign Up Form</h1>
                    <br>

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" style="color:white"><br>
                    <label for="username">Phone Number:</label>
                    <input placeholder="" name="phone" id="phone">
                    <label for="email">Email:</label>
                    <input id="email" name="email" style="color: white"><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" style="color: white"><br>
                    <label for="confirm-password">Confirm Password:</label>

                    <input type="password" id="confirm-password" name="confirm-password" style="color: white"><br>

                    <input type="submit" name="submit" value="Sign Up" style="color: white">
                </div>
            </form>
        </div>
    
<!------Footer------->
<?php include('./partials/footer.php'); ?>

<?php

if(isset($_POST['submit'])){
    // Button clicked
    // echo "Button Clicked";

    // Get the data from form
    $new_name = $_POST['username'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
    $new_password = md5($_POST['password']);

    $sql = "INSERT INTO `Users` (`Name`, `Phone` , `Email`, `Password`) VALUES ('$new_name' , '$new_phone', '$new_email', '$new_password');";
    $res = mysqli_query($conn,$sql);
    if($res){
        // Data inserted 
        // echo "Data inserted";
        // Create a session variable to display message
        $_SESSION['add'] = "success";
        // Redirect page
        header("location:".SITEURL.'home.php');
    }
    else{
        // Failed to insert data
        $_SESSION['add'] = "<div class=\"error\">Failed to add admin</div>";
        // Redirect page to add admin
        // header("location:".SITEURL.'admin1/add_admin.php');
    }
}
?>

<?php
    if(isset($_SESSION['add'])){
        $class = ($_SESSION['add'] == 'success') ? 'success' : 'error';
?>
        <script>
            alert("<?php echo ($_SESSION['add'] == 'success') ? 'Loged In Successfully' : 'Failed to Log In'; ?>");
        </script>
<?php
        unset($_SESSION['add']);
    }
?>