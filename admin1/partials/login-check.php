<?php
    //Authorization - Access control
    //Check whether the user is logged in or not
    if(!isset($_SESSION['user']))//if user session isnt set
    {
        //user isnt logged in
        //Redirect to Login Page with message
        $_SESSION['no-login-message'] = "<div class =\"error text_center\">Please Login to access Admin Panel</div>";
        //Redirect to Login Page
        header('location:'.SITEURL.'/admin1/login.php');
        //make changes in menu.php, video timing - 40:36
    }
?>