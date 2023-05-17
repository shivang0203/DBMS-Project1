<?php include('partials/menu.php') ?>
<?php include('./config1/constants.php'); ?>

<!-- Main content section starts -->
<div class="main_content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
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

        <!-- Button to add admin-->
        <br><br>
        <a href="add_admin.php" class="btn_primary">Add Admin</a>
        <br /><br /><br />


        <table class="tbl_full">
            <tr>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `table_admin`";
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
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the values in our table
            ?>

                        <!-- Html part -->
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?> </td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>/admin1/update_password.php?id=<?php echo $id; ?>" class="btn_primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>/admin1/update_admin.php?id=<?php echo $id; ?>" class="btn_secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>/admin1/delete_admin.php?id=<?php echo $id; ?>" class="btn_danger">Delete Admin</a>
                            </td>
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