<?php include('partials/menu.php'); ?>
<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Add Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>



        <form action='' method='GET'>
            <table class='tbl-30'>
                <tr>
                    <td>First Name: </td>
                    <td> <input type="text" name='first_name' placeholder="Enter Your First Name"></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td> <input type="text" name='last_name' placeholder="Enter Your Last Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td> <input type="text" name='username' placeholder="Enter Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td> <input type="password" name='password' placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name='submit' value='Add Admin' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>


<?php


if (isset($_GET['submit'])) {
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $username = $_GET['username'];
    $password = md5($_GET['password']);

    $sql = "INSERT INTO admin SET
        First_Name_admin = '$first_name',
        Last_Name_admin = '$last_name',
        username = '$username',
        password = '$password'
        ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error('error'));


    if ($res == TRUE) {
        $_SESSION['add'] = '<div class = "success"> Admin Added Successfully</div>';
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = "<div class = 'error'> Failed To Add Admin</div>";
        header('location:' . SITEURL . 'admin/add-admin.php');
    }
}

?>