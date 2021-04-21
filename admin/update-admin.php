<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Update Admin</h1>
        <br><br>


        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id_admin=$id";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $first_name = $row['First_Name_admin'];
                $last_name = $row['Last_Name_admin'];
                $username = $row['username'];
            } else {
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }

        ?>

        <form action='' method="GET">
            <table class='tbl-30'>
                <tr>
                    <td>First Name</td>
                    <td>
                        <input type="text" name='first_name' value="<?php echo $first_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>
                        <input type="text" name='last_name' value="<?php echo $last_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name='username' value="<?php echo $username ?>">
                    </td>
                <tr>
                    <td colspan="2">
                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        <input type="submit" name='submit' value="Update Admin" class='btn-secondary'>
                    </td>
                </tr>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_GET['submit'])) {

    $id = $_GET['id'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $username = $_GET['username'];

    $sql = "UPDATE admin SET 
        First_name_admin = '$first_name',
        Last_name_admin = '$last_name',
        username = '$username'
        WHERE id_admin='$id'
        ";

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['update'] = "<div class = 'success'> Admin Updated Succsessfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update'] = "<div class = 'error'> Failed To Update Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>


<?php include('partials/footer.php'); ?>