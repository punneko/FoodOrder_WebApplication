<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql="SELECT * FROM orders WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1){
                    $row=mysqli_fetch_assoc($res);

                    $food=$row['food'];
                    $status=$row['status'];
                    
                }else{
                    header('location:'.SITEURL.'food_order/manage_order.php');
                }
            }else{
                header('location:'.SITEURL.'food_order/manage_order.php');
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
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                   <td> <b>
                        <?php
                            echo $food;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <input type="radio" name="status" <?php if($status=="Paid"){echo "checked";}?> value="Paid">Paid</input>
                        <input type="radio" name="status" <?php if($status=="Served"){echo "checked";}?> value="Served">Served</input>
                        <input type="radio" name="status" <?php if($status=="Cancelled"){echo "checked";}?> value="Cancelled">Cancelled</input>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Update category form end-->
        <?php 
            //check whether the submit button is click or not
            if(isset($_POST['submit'])){
                //echo "Clicked";
                //1.get the vaule from order form
                $id=$_POST['id'];
                $status=$_POST['status'];

                //2.update the DB
                $sql2="UPDATE orders SET 
                         status='$status' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);
                //4.redirect
                if($res2== TRUE){
                    $_SESSION['update']="<div class='success'>Updated Successfully.</div>";
                    header('location:'.SITEURL.'food_order/manage_order.php');
                }else{
                    $_SESSION['update']="<div class='error'>Failed to Updated.</div>";
                    header('location:'.SITEURL.'food_order/manage_order.php');
                }
               
              
               
            }
        
        ?>
    </div>
</div>

<?php include('footer.php')?>