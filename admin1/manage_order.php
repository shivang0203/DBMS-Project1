<?php include('partials/menu.php') ?>
<!-- Main content section starts -->
<div class="main_content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br /><br /><br />

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
        ?>
        <br><br>

        <table class="tbl_full">
            <tr>
                <th>S.No.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM `table_order`";
                $res = mysqli_query($conn, $sql);
                if ($res == TRUE) {
                    // Count the rows to check wheter we have data in database or not
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    // check the number of rows
                    if ($count > 0) {
                        // We have data in data base
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // using while loop to get all the data from database
    
                            // get individual data
                            $id = $rows['id'];
                            $food_id = $rows['food_id'];
                            $sql22 = "SELECT `table_food`.`title` FROM `table_food` WHERE `table_food`.`id` = $food_id";
                            $res22 = mysqli_query($conn, $sql22);
                            $row22 = mysqli_fetch_assoc($res22);
                            $title22 = $row22['title'];
                            $price = $rows['price'];
                            $quantity = $rows['quantity'];
                            $total = $rows['total'];
                            $order_date = $rows['order_date'];
                            $status = $rows['status'];
                            $customer_name = $rows['customer_name'];
                            $customer_address = $rows['customer_address'];
                            $customer_contact = $rows['customer_contact'];
                            $customer_email = $rows['customer_email'];
                            
    
                            // display the values in our table
                ?>
    
                            <!-- Html part -->
                            <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title22;?></td>
                    <td><?php echo $price;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo $total;?></td>
                    <td><?php echo $order_date;?></td>

                    <td>
                        <?php
                            if($status=="Ordered")
                            {
                                echo "<label>$status</label>";
                            }
                            else if($status=="On Delivery")
                            {
                                echo "<label style ='color: orange;'>$status</label>";
                            }
                            else if($status=="Delivered")
                            {
                                echo "<label style ='color: green;'>$status</label>";
                            }
                            else if($status=="Cancelled")
                            {
                                echo "<label style ='color: red;'>$status</label>";
                            }
                        ?>
                    </td>

                    <td><?php echo $customer_name;?></td>
                    <td><?php echo $customer_contact;?></td>
                    <td><?php echo $customer_email;?></td>
                    <td><?php echo $customer_address;?></td>
                    
                    <td>
                        <a href="<?php echo SITEURL;?>admin1/update_order.php?id=<?php echo $id;?>" class="btn_secondary">Update Order</a>
                    </td>
                </tr>
    
    
                <?php
                        }
                    } else {
                        // we have no data in database
                        echo "<tr><td colspan='12' class='error'>Orders Not Availavle.</td></tr>";
                    }
                }
                ?>
                

            
        </table>

    </div>
</div>
<!-- main content section ends -->

<?php include('partials/footer.php') ?>