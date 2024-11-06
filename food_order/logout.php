<?php
    include('connect.php');
    //1.destroy the seesion
    session_destroy(); //unsets $_session['user]

    //2.redirect to login page
    header('location:'.SITEURL.'food_order/login.php');
?>