<?php
     include('connect.php');
     //check whether the query executed successfully or not
     if(isset($_GET['id']) AND isset($_GET['image_name'])){
         //1.get the ID of admin to be deleted
        $id = $_GET['$id'];
        $image_name =$_GET['image_name'];
        //remove image file
        if($image_name!=""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['remove'] = "<div class = 'error'>Failed to remove Food Image.</div>";
                header('location:'.SITEURL.'food_order/manage_food.php');
                die();
            }
        }
        //2.delete data from DB
        $sql = "DELETE FROM food WHERE id =$id";
        //execute the query
         $res = mysqli_query($conn, $sql);
        
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Deleted Successfully.</div>";
            //redirect
            header('location:'.SITEURL.'food_order/manage_food.php');
        }else{
            $_SESSION['delete'] = "<div class = 'error'>Failed to Delete.</div>";
            header('location:'.SITEURL.'food_order/manage_food.php');
        }
        
     }else{
         //echo "Failed to Delete";
         $_SESSION['unauthorized'] = "<div class = 'error'>Unauthorised Access.</div>";
         header('location:'.SITEURL.'food_order/manage_food.php');
     }
?>