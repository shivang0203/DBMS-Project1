<?php include('partials_front/menu.php'); 
$order_id=100;
?>






<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" class="order" method=Post>
            <fieldset>
                <legend>Selected Food</legend>
                <?php
                $sql100 = "SELECT * FROM `temp`";
                $res100 = mysqli_query($conn, $sql100);
                $count100 = mysqli_num_rows($res100);
                if ($res100) {
                    $kuku =0;
                    while ($rows = mysqli_fetch_assoc($res100)) {
                        $food_id = $rows['food_id'];
                        $sql200 = "SELECT * FROM `table_food` WHERE `table_food`.`id`=$food_id";
                        $res200 = mysqli_query($conn, $sql200);
                        $row200 = mysqli_fetch_assoc($res200);

                        $title = $row200['title'];
                        $description = $row200['description'];
                        $price = $row200['price'];
                        $image_name = $row200['image_name'];
                        // $current_category = $row2['category_id'];
                        // $featured = $row2['featured'];
                        // $active = $row2['active'];
                ?>

                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available</div>";
                            } else {

                            ?>
                                <img src="<?php echo SITEURL; ?>imag/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <h3><?php echo $title; ?></h3>
                            <input type="hidden" name="food" value="<?php echo $food_id; ?>">
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" required>

                        </div>
                <?php
                    $kuku++;
                    }
                } else {
                    // no food added in cart
                }
                ?>


            </fieldset>


            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        if (isset($_POST['submit'])) {


            // fill all the items in the cart table
            // $food = $_POST['food'];
            // $price1 = $_POST['price'];
            // for($i = 0; $i<$kuku;$i++){
            //     $qty = $_POST['qty.$i'];
            //     $total = $price * $qty;
            //     $sql200 = "INSERT INTO `Cart` SET
            //         order_id= $order_id,
            //         food_id= $food_id,
            //         quantity = $qty,
            //         total = $total,
            //         order_date = '$order_date',
            //         status = '$status',
            //         customer_name = '$customer_name',
            //         customer_contact = '$customer_contact',
            //         customer_email = '$customer_email',
            //         customer_address = '$customer_address',
            //         price = $price;";
            // }
            
            $qty = $_POST['qty'];
                $total = $price * $qty;
            $order_date = date("Y-m-d h:i:s");
            $status = "Ordered";
                // $order_id=100;
            $food_id = $_POST['food'];
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];


            // $sql2 =  "INSERT INTO `table_order` (`food_id`,`quantity`,`total`,`order_date`,`status`,`customer_name`,`customer_contact`,`customer_email`,`customer_address`,`price`) VALUES ('$food_id' ,`$qty`, `$total`, `$order_date`, '$status', '$customer_name','$customer_contact','$customer_email','$customer_address',`$price`)";
            // $sql2 = "INSERT INTO `table_order` SET
            //     food= '$food',
            //     price = $price,
            //     quantity = $qty,
            //     total = $total,
            //     order_date = '$order_date',
            //     status = '$status',
            //     customer_name = '$customer_name',
            //     customer_contact = '$customer_contact',
            //     customer_email = '$customer_email',
            //     customer_address = '$customer_address'
            // ";


            $sql2 = "INSERT INTO `table_order` SET
                    order_id= $order_id,
                    food_id= $food_id,
                    quantity = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address',
                    price = $price;";
            $order_id++;


            // echo $sql2; die();
            $res2 = mysqli_query($conn, $sql2);
            // echo $res2; die();
            if ($res2 == TRUE) {
                // echo $sql2; die();
                $_SESSION['order'] = "<div class=\"success\">Food ordered Successfully.</div>";
                header('location:' . SITEURL);
            } else {
                $_SESSION['order'] = "<div class=\"error\">Failed to order.</div>";
                header('location:' . SITEURL);
            }
        }

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<?php include('./partials_front/footer.php'); ?>