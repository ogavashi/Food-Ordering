<?php include('partials/menu.php'); ?>

<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql2 = "SELECT * FROM product WHERE id_product=$id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['Product_name'];
    $description = $row2['Description'];
    $price = $row2['Price'];
    $current_image = $row2['Img_ref'];
    $current_category = $row2['category_id'];
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>



<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Update Product</h1>
        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Descrition:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php

                            $sql = "SELECT * FROM category";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);


                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['Category_name'];
                                    $category_id = $row['id_category'];

                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                            ?>
                        </select>
                    </td>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if (isset($_FILES['image']['name'])) {
                
                $image_name = $_FILES['image']['name']; 

                
                if ($image_name != "") {
                    
                    $ext = end(explode('.', $image_name)); 

                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext; 

                   
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/" . $image_name; 


                    $upload = move_uploaded_file($src_path, $dest_path);

                 
                    if ($upload == false) {
                        
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                      
                        header('location:' . SITEURL . 'admin/manage-food.php');
                       
                        die();
                    }
                    
                    if ($current_image != "") {
                        
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        
                        if ($remove == false) {
                            
                            $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                           
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image; 
            }

            $sql3 = "UPDATE product SET
                    Product_name='$title',
                    Description='$description',
                    Price=$price,
                    Img_ref='$image_name',
                    id_category=$category
                    WHERE id_product=$id
                ";
            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == TRUE) {
                $_SESSION['add'] = "<div class='success'>Product Updated Succsessfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed To Update Product</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>