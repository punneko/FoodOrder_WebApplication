<?php include('connect.php');?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="shortcut icon" href="../images/malatang.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body style="background-image: linear-gradient(#ffefcb,#f6e3ba,#c51010,#990000);">
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!--Login Form Starts Here-->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username">
                <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password">
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!--Login Form Ends Here-->

            <p></p>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        //process for login
        //1.get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2.SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM admin WHERE username='$username' AND password ='$password'";

        //3.execute the query
        $res = mysqli_query($conn, $sql);

        //4.count rows to check whether the user exist or not
        $count=mysqli_num_rows($res);

        if($count==1){
            //user available and login succeess
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //to check whether the useer is logged in or not
            header('location:'.SITEURL.'food_order/index.php');
        }else{
            //user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'food_order/login.php');
        }
    }
?>