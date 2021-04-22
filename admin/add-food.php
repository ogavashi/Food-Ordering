<?php include('partials/menu.php'); ?>
<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Add Product</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>


        <form action='' method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type='text' name='title' placeholder="Name Of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Descrition: </td>
                    <td>
                        <textarea name='description' cols='30' rows='5' placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name='price'>
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name='image'>
                    </td>
                </tr>
                <tr>
                    <td>Select Categoty: </td>
                    <td>
                        <select name='category'>
                            <?php
                            $sql = "SELECT * FROM category";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id_category'];
                                    $title = $row['Category_name'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if (isset($_FILES['image'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $ext = end(explode('.', $image_name));

                    $image_name = "Product-Name-" . rand(0000, 9999) . '.' . $ext;

                    $src = $_FILES['image']['tmp_name'];

                    $dst = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = "lox";
            }
            $sql2 = "INSERT INTO product SET
                    Product_name='$title',
                    Description='$description',
                    Price=$price,
                    Img_ref='$image_name',
                    id_category=$category
                ";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['add'] = "<div class='success'>Product Added Succsessfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed To Add Product</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>