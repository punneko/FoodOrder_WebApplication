<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql2="SELECT * FROM food WHERE id=$id";
                $res2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($res2);
                $title=$row2['title'];
                $description=$row2['description'];
                $price=$row2['price'];
                $current_image=$row2['image_name'];
                $active=$row2['active'];
                
            }else{
                header('location:'.SITEURL.'food_order/manage_food.php');
            }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!--Update category form start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" vaule="<?php echo $title;?>" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" vaule="<?php echo $description;?>"placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                <td>Price: </td>
                    <td>
                        <input type="number" name="price" vaule="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php

                            }else{
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                //create PHP code to display categories from DB
                                //1.create SQL to get all active categories from DB
                                $sql = "SELECT * FROM category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        //echo "<option value='$category_id'>$category_title</option>";  
                                        ?>
                                        <option <?php  if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?>
                                        </option>
                                        <?php
                                    }
                                }else{
                                    echo "<option value='0'>Category Not Available.</option>";
                                }  
                            
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Update category form end-->
        <?php 
            //check whether the submit button is click or not
            if(isset($_POST['submit'])){
                //echo "Clicked";
                //1.get the vaule from food form
                $id=$_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image=$_POST['current_image'];
                $category = $_POST['category'];
                $active=$_POST['active'];

                //2.updating new image
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name!=""){
                        //rename the iamge
                        $ext = end(explode('.',$image_name));
                        $image_name = "Food-Name".rand(0000,9999).".".$ext; //new image name
                        //upload the image
                        //get the src path and description path
                        //source path is the current location of the image
                        $src=$_FILES['image']['tmp_name'];
                        //description path for the image to be unploaded
                        $dst="../images/food/".$image_name;
                        //finally upload
                        $upload = move_uploaded_file($src, $dst);
                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'food_order/manage_food.php');
                            //stop process
                            die();
                        }
                        //remove the current image
                        if($current_image!=""){
                            $remove_path="../images/food".$current_image;
                            $remove = unlink($remove_path);
                            if($remove==false){
                                $_SESSION['failed-remove'] = "<div class = 'error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'food_order/manage_food.php');
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }
               }else{
                $image_name = $current_image;
               }
                //3.update the DB
                $sql3="UPDATE food SET 
                        title='$title', description='$description', price=$price, image_name='$image_name',
                        category_id=$category, active='$active' WHERE id=$id";
                $res3=mysqli_query($conn, $sql3);
                //4.redirect
                if($res3== TRUE){
                    $_SESSION['update']="<div class='success'>Updated Successfully.</div>";
                    header('location:'.SITEURL.'food_order/manage_food.php');
                }else{
                    $_SESSION['update']="<div class='error'>Failed to Updated.</div>";
                    header('location:'.SITEURL.'food_order/manage_food.php');
                }
               
              
               
            }
        
        ?>
    </div>
</div>

<?php include('footer.php')?>