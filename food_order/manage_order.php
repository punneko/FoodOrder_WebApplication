<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            // get all the orders from DB
            $sql = "SELECT * FROM orders ORDER BY id DESC"; //display the latest
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn=1;
            if ($count > 0) {
                //order Available
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $status = $row['status'];

                                        // Decode the JSON string into a PHP array
                    $foodArray = json_decode($food, true);

                    // Initialize an empty string to store the formatted data
                    $formattedFood = '';

                    // Iterate through the array and concatenate the values with commas
                    foreach ($foodArray as $index => $item) {
                        // Append the item to the formatted string
                        $formattedFood .= $item;

                        // If it's not the last item, add a comma
                        if ($index < count($foodArray) - 1) {
                            $formattedFood .= ', ';
                        }
                    }
            ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $formattedFood; ?></td>
                        <td><?php 
                            if($status=="Paid"){
                                echo "<label style='color:yellow;'>$status</label>";
                            }else if($status=="Served"){
                                echo "<label style='color:green;'>$status</label>";
                            }else if($status=="Cancelled"){
                                echo "<label style='color:red;'>$status</label>";
                            }
                        ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>food_order/update-order.php? id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>

            <?php

                }
            } else {
                //order not available
                echo "<tr><td colspan='8'><div class='error'>Order not Available.</div></td></tr>";
            }
            ?>


        </table>
    </div>
</div>
<?php include('footer.php'); ?>