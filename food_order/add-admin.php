<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <?php
             if(isset($_SESSION['add']))
             {
                 echo $_SESSION['add'];
                 unset($_SESSION['add']); //removing message
             }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"> </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username"> </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"> </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
//process the value from Form and Save it in DB
//Check wheter the submit button is clicked or not
if (isset($_POST['submit'])) {
    //Buttot Clicked
    //echo"Button Clicked"

    //1.Get the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with MD5
    //2.SQL Query to Save the data into DB
    $sql = "INSERT INTO admin SET
            full_name ='$full_name', 
            username ='$username', 
            password ='$password'
        ";
    //3.Execute Query and Save Data in DB
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. check whether the(Query is execute) data is inserted or not and display appropriate message
    if($res==true){
        //echo "Data Inserted";
        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Added Successfully. </div>";
        //redirect page to manage admin
        header("location:".SITEURL.'food_order/manage_admin.php');
    }else{
        //echo "Faile to Insert Date";
        //create a session variable to display message
        $_SESSION['add'] = "<div class = 'error'>Failed to Add. </div>";
        //redirect page to manage admin
        header("location:".SITEURL.'food_order/add-admin.php');
    }
}

?>
<?php include('footer.php'); ?>