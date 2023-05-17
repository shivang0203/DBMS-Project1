<!-- Make chota changes on menu.php, video timing : 29:26 -->

<?php

    //Include config.php for SITEURL
    include('./config1/constants.php');
    //Destroy the session and redirect to login page

    //1. Destroy
    session_destroy(); //Unsets $_SESSION['user']

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin1/login.php');

?>