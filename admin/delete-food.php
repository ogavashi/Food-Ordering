<?php

include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != '') {
        $path = "../images/food/" . $image_name;

        $remove = unlink($path);

        if ($remove == FALSE) {
            $_SESSION['upload'] = "<div class='error'>$path</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }
    $sql = "DELETE FROM product WHERE id_product=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Product</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
