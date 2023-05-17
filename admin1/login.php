<?php include ('./config1/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel = "stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class = "login">
            <h1 class = "text_center">Login</h1>
            <br><br>
            
            <!-- Copy and paste the same in index.php, video time - 25:30 -->
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br><br>
            
            <form action ="" method="POST" class="text_center">

                Username: <br>
                <input type ="text" name="username" placeholder = "Enter username"><br><br>

                Password: <br>
                <input type ="password" name="password" placeholder = "Enter password"><br><br>

                <input type ="submit" name="submit" value="Login" class="btn_primary">
                <br><br>
            </form>
            <p class = "text_center">Created by OP Teamers</p>
        </div>
    </body>
</html>

<?php

    //Check whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exst or not
        $sql = "SELECT * FROM `table_admin` WHERE username = $username AND password = '$password' ";

        //3. Execute query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //User available and Login success
            $_SESSION['login'] = "<div class=\"success\">Login successful.</div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
            //make some chnages in menu.php, video timing - 35:55 

            //Redirect to Home Page/ Dashboard
            header('location:'.SITEURL.'admin1');
        }
        else{
            //User not available and Login failed
            $_SESSION['login'] = "<div class =\"error text_center\"> Username or Password didnt match.</div>";
            //Redirect to Home Page/ Dashboard
            header('location:'.SITEURL.'admin1/login.php');
        }
    }

?>
