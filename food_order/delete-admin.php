<?php 

    include('connect.php');
    //1.get the ID of admin to be deleted
    $id = $_GET['id'];
    //2.create SQL Query to Delete admin
    $sql = "DELETE FROM admin WHERE id =$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the query executed successfully or not
    //3.Redirect to Manage Admin page with messge(success/error)
    if($res==TRUE){
        //echo "Admin Deleted";
        $_SESSION['delete'] = "<div class='success'>Deleted Successfully.</div>";
        header('location:'.SITEURL.'food_order/manage_admin.php');
    }else{
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class = 'error'>Failed to Delete.</div>";
        header('location:'.SITEURL.'food_order/manage_admin.php');
    }
    

?>