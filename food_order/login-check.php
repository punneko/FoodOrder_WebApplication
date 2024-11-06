<?php
    //authorization-access control
    //check wherther the user is logged in or not
    if(!isset($_SESSION['user'])) //if user seesion is not set
    {
        //user is not logged in
        //redirect to log in page
        $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'food_order/login.php');
    }
?>