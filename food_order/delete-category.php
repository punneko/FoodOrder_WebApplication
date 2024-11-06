<?php
     include('connect.php');
     //check whether the query executed successfully or not
     if(isset($_GET['id']) AND isset($_GET['image_name'])){
         //1.get the ID of admin to be deleted
        $id = $_GET['id'];
        $image_name =$_GET['image_name'];
        //remove image file
        if($image_name!=""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['remove'] = "<div class = 'error'>Failed to remove Category Image.</div>";
                header('location:'.SITEURL.'food_order/manage_category.php');
                die();
            }
        }
        //2.delete data from DB
        $sql = "DELETE FROM category WHERE id =$id";
        //execute the query
         $res = mysqli_query($conn, $sql);
        
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Deleted Successfully.</div>";
            //redirect
            header('location:'.SITEURL.'food_order/manage_category.php');
        }
        
     }else{
         //echo "Failed to Delete";
         $_SESSION['delete'] = "<div class = 'error'>Failed to Delete.</div>";
         header('location:'.SITEURL.'food_order/manage_category.php');
     }
?>