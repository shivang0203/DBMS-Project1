<?php include('partials_front/menu.php'); ?>

<?php
if (isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];
    $sql1 = "INSERT INTO `temp` (`food_id`) VALUES ($food_id)";
    $res2 = mysqli_query($conn, $sql1);
    header('location:'.SITEURL.'foods.php');
    // $sql = "SELECT * FROM `table_food` WHERE `table_food`.`id`='$food_id'";
    // $res = mysqli_query($conn, $sql);
    // $count = mysqli_num_rows($res);

    // if ($count == 1) {
    //     $row = mysqli_fetch_assoc($res);
    //     $title = $row['title'];
    //     $price = $row['price'];
    //     $description = $row['description'];
    //     $image_name = $row['image_name'];

    // } else {
    //     header('location:'.SITEURL);
    // }
} else {
    header('location:'.SITEURL.'foods.php');
}
?>
