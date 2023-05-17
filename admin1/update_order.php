<?php include('partials/menu.php') ?>
<div class="main_content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM `table_order` WHERE `table_order`.`id`=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food_id'];
                    $sql2 = "SELECT `table_food`.`title` FROM `table_food` WHERE `table_food`.`id` = $food";
                    $res2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($res2);
                    $title = $row2['title'];
                    $price = $row['price'];
                    $qty = $row['quantity'];
                    $status = $row['status'];

                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else{
                    header('location:'.SITEURL.'admin1/manage_order.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin1/manage_admin.php');
            }
        ?>
        <form action="" method = POST >
            <table class="tbl_30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $title; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b>Rs. <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered") {echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery") {echo "selected";} ?>value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered") {echo "selected";} ?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled") {echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value="<?php echo $id; ?>">
                        <input type="hidden" name = "price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                // $id = $_POST['id'];
                // $price = $_POST['price'];
                $qty1 = $_POST['qty'];
                $total1 = $price * $qty1;
                $status1 = $_POST['status'];

                $customer_name1 = $_POST['customer_name'];
                $customer_contact1 = $_POST['customer_contact'];
                $customer_email1 = $_POST['customer_email'];
                $customer_address1 = $_POST['customer_address'];

                $sql3 = "UPDATE `table_order` SET
                    quantity = $qty1,
                    total = $total1,
                    status = '$status1',
                    customer_name = '$customer_name1',
                    customer_contact = '$customer_contact1',
                    customer_email = '$customer_email1',
                    customer_address = '$customer_address1'
                    WHERE id = $id;
                ";
                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin1/manage_order.php');
                }
                else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin1/manage_order.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php') ?>