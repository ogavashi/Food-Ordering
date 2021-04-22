<?php
    include('../config/constants.php');

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql="DELETE FROM category  WHERE id_category=$id";

        $res=mysqli_query($conn, $sql);

        if($res==TRUE){
            $_SESSION['delete']="<div class='success'>Category Deleted Succsessfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete']="<div class='error'>Failed To Delete Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        header(('location:'.SITEURL.'admin/manage-category.php'));
    }


?>