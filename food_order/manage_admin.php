<?php include('menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <br><br>
        <!--Button to Add Admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all admin
            $sql = "SELECT * FROM admin";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //check whether the query is executed of not
            if ($res == TRUE) {
                //count Rows to check whether we have data in DB or not
                $count = mysqli_num_rows($res);
                $sn = 1; //create a variable and assign the value
                //check the num of rows
                if ($count > 0) {
                    //we have data in DB
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data from DB
                        //and while loop will run as long as we have data in DB
                        //get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //display the vaules in our table
            ?>

                        <tr>
                            <td><?php echo $sn++ ?>.</td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } 
            }
            ?>

        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('footer.php'); ?>