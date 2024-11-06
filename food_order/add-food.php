<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                <td>Price: </td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                <td>Select image: </td>
                    <td>
                        <input type="file" name="image" >
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
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php echo $id?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" >Yes
                        <input type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                //1.get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }
                //2.upload the image if selected
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
                            header('location:'.SITEURL.'food_order/add-food.php');
                            //stop process
                            die();
                        }

                    }
                }else{
                    $image_name = "";
                }
                //3.insert into DB
                $sql2="INSERT INTO food SET 
                    title='$title', description='$description', price=$price, image_name='$image_name',
                    category_id=$category, active='$active'";
                $res2=mysqli_query($conn, $sql2);
                if($res2 == TRUE){
                    $_SESSION['add']="<div class='success'>Added Successfully.</div>";
                    header('location:'.SITEURL.'food_order/manage_food.php');
                }else{
                    $_SESSION['add']="<div class='error'>Failed to Add.</div>";
                    header('location:'.SITEURL.'food_order/manage_food.php');
                }
                //4.redirect to manage food page
            }
        ?>

    </div>
</div>
<?php include('footer.php');?>