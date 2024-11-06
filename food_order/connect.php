<?php

//Start session
session_start();
//create constants to store Non Repeating values
define('SITEURL','http://fengqu.lovestoblog.com/'); //ex.http://localhost/food-order/
define('LOCALHOST', 'sql105.infinityfree.com');
define('DB_USERNAME', 'if0_36223589');
define('DB_PASSWORD', 'fengqulovetoeat');
define('DB_NAME', 'if0_36223589_fengqu_order');
//3.Execute Query and Save Data in DB
//DB connections
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
//selecting DB
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
//$res = mysqli_query($conn, $sql) or die(mysqli_error());
?>