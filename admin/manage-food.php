<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Manage Product</h1>
        <br /><br />
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class='btn-primary'> Add Food </a>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }

        ?>

        <table class='tbl-full'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM product";
            $sql2 = 'SELECT * FROM product, category
            WHERE category.id_category = product.id_category';

            $res = mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_product'];
                    $title = $row['Product_name'];
                    $price = $row['Price'];
                    $image_name = $row['Img_ref'];
                    $category = $row['Category_name'];
            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td>$<?php echo $price ?></td>
                        <td><?php
                            if ($image_name == '') {
                                echo "<div class='error'>Image Not Added.</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $category?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class='btn-secondary'> Update Food </a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class='btn-danger'> Delete Food </a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr> <td colspan='7' class='error'> Food Not Added Yet </td> </tr>";
            }


            ?>

        </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>