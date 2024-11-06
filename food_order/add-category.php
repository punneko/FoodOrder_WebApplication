<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
        ?>
        <br><br>
        <!--Add category form start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Catergory Title">
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add category form end-->
        <?php 
            //check whether the submit button is click or not
            if(isset($_POST['submit'])){
                //echo "Clicked";
                //1.get the vaule from category form
                $title = $_POST['title'];
                //for radio input we need to check the button is select or not
                if(isset($_POST['active'])){
                    //Get the vaule from form
                    $active = $_POST['active'];
                }else{
                    //set the dafault value
                    $active = "No";
                }
                //2.create SQL to insert category into DB
                $sql = "INSERT INTO category SET title='$title', active='$active'";
                //3.execute the query and save in DB
                $res = mysqli_query($conn,$sql);
                //4.check whether the query executed or not and data added or not
                if($res==true){
                    //Query executed and category added
                    $_SESSION['add']="<div class='success'>Added Successfully.</div>";
                    //redirect
                    header('location:'.SITEURL.'food_order/manage_category.php');
                }else{
                    //failed to add
                    $_SESSION['add']="<div class='error'>Failed to Add.</div>";
                    //redirect
                    header('location:'.SITEURL.'food_order/manage_category.php');
                }
            }
        
        ?>
    </div>
</div>

<?php include('footer.php')?>