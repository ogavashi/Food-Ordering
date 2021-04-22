<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Manage Category</h1>
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
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br /><br /><br />

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class='btn-primary'> Add Category </a>
        <br /><br /><br />

        <table class='tbl-full'>
            <tr>
                <th>ID</th>
                <th>Catgory Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $sql2 = 'SELECT * FROM category, type
            WHERE category.id_type = type.id_type';

            $res = mysqli_query($conn, $sql2);

            $sn = 1;

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_category'];
                    $category_name = $row['Category_name'];
                    $type = $row['Type_name'];
            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $category_name ?></td>
                        <td><?php echo $type ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id?>" class='btn-secondary'> Update Category </a>
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id?>" class='btn-danger'> Delete Category </a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class='error'>No Category Added</div>
                    </td>
                </tr>
            <?php

            }

            ?>





        </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>