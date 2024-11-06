<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql="SELECT * FROM category WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1){
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $active=$row['active'];
                    
                }else{
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'food_order/manage_category.php');
                }
            }else{
                header('location:'.SITEURL.'food_order/manage_category.php');
            }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
        ?>
        <br><br>
        <!--Update category form start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" vaule="<?php echo $title;?>" placeholder="Catergory Title">
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Update category form end-->
        <?php 
            //check whether the submit button is click or not
            if(isset($_POST['submit'])){
                //echo "Clicked";
                //1.get the vaule from category form
                $id=$_POST['id'];
                $title = $_POST['title'];
                $active=$_POST['active'];
                //3.update the DB
                $sql2="UPDATE category SET 
                        title='$title', active='$active' WHERE id=$id";
                $res2=mysqli_query($conn, $sql2);
                //4.redirect
                if($res2== TRUE){
                    $_SESSION['update']="<div class='success'>Updated Successfully.</div>";
                    header('location:'.SITEURL.'food_order/manage_category.php');
                }else{
                    $_SESSION['update']="<div class='error'>Failed to Updated.</div>";
                    header('location:'.SITEURL.'food_order/manage_category.php');
                }
               
              
               
            }
        
        ?>
    </div>
</div>

<?php include('footer.php')?>