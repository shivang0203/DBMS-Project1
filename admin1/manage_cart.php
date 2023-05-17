<?php include('partials/menu.php') ?>
<?php include('./config1/constants.php'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Manage Cart</h1>
        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
            // echo "hello";
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
            // echo "hello";
        };
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
            // echo "hello";
        };
        if (isset($_SESSION['user_not_found'])) {
            echo $_SESSION['user_not_found'];
            unset($_SESSION['user_not_found']);
            // echo "hello";
        };
        if (isset($_SESSION['change_password'])) {
            echo $_SESSION['change_password'];
            unset($_SESSION['change_password']);
            // echo "hello";
        };
        
        ?>

        <br><br>

        <br /><br /><br />


        <table class="tbl_full">
            <tr>
                <th>S.No.</th>
                <th>Order Number</th>
                <!-- <th>Item number </th> -->
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `Cart`";
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
                            $order_id = $rows['order_id'];
                            $food_id = $rows['food_id'];
                            $sql22 = "SELECT `table_food`.`title` FROM `table_food` WHERE `table_food`.`id` = $food_id";
                            $res22 = mysqli_query($conn, $sql22);
                            $row22 = mysqli_fetch_assoc($res22);
                            $title22 = $row22['title'];
                            $price = $rows['price'];
                            $quantity = $rows['quantity'];

                        // display the values in our table
            ?>

                        <!-- Html part -->
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $order_id; ?> </td>
                            <td><?php echo $title22; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                        </tr>


            <?php
                    }
                } else {
                    // we have no data in database
                }
            }
            ?>
        </table>

    </div>
</div>
<!-- main content section ends -->

<?php include('partials/footer.php') ?>