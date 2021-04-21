<?php 

    include('../config/constants.php');


    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id_admin=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['delete'] = '<div class = "success"> Admin Deleted Successfully</div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class = 'error'> Failed To Delete Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>