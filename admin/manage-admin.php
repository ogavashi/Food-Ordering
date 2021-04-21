<?php include('partials/menu.php'); ?>
<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Manage Admin</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }

        ?>
        <br><br>
        <a href="../admin/add-admin.php" class='btn-primary'> Add Admin </a>
        <br /><br /><br />

        <table class='tbl-full'>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = 'SELECT * FROM admin';
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {

                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id_admin'];
                        $first_name = $rows['First_Name_admin'];
                        $last_name = $rows['Last_Name_admin'];
                        $username = $rows['username'];

            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $first_name ?></td>
                            <td><?php echo $last_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class='btn-primary'>Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class='btn-secondary'> Update Admin </a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class='btn-danger'> Delete Admin </a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                }
            }
            ?>

        </table>



    </div>
</div>
<?php include('partials/footer.php'); ?>