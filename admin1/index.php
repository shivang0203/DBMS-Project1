<?php include('partials/menu.php')?>
<br><br>
<?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
?>
<br><br>

    <!-- Main content section starts -->
    <div class="main_content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>

            <div class="col_4 text_center">
                <h1><?php 
                    $sql = "SELECT * FROM `table_category`";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    echo $count;
                ?></h1>
                <br/>
                Categories
            </div>

            <div class="col_4 text_center">
                <h1><?php 
                    $sql1 = "SELECT * FROM `table_food`";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    echo $count1;
                ?></h1>
                <br/>
                Foods
            </div>

            <div class="col_4 text_center">
                <h1><?php 
                    $sql3 = "SELECT * FROM `table_order`";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    echo $count3;
                ?></h1>
                <br/>
                Total Orders
            </div>

            <div class="col_4 text_center">
                <h1><?php 
                    $sql4 = "SELECT SUM(total) AS TOTAL FROM `table_order`";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    echo $row4['TOTAL'];
                ?></h1>
                <br/>
                Revenue Generated
            </div>
            <div class="clear_fix"></div>

        </div>
    </div>
    <!-- main content section ends -->


<?php include('partials/footer.php')
?>   