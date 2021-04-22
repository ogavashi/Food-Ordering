<?php include('partials/menu.php'); ?>
<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Update Category</h1>
        <br /><br />

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM category WHERE id_category=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['Category_name'];
                $type = $row['id_type'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="GET" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Category Name:</td>
                    <td>
                        <input type="text" name='title' value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Select Type:</td>
                    <td>
                        <input <?php if ($type == '1') {
                                    echo "checked";
                                } ?> type='radio' name='type' value='1' required> Dishes
                        <input <?php if ($type == '2') {
                                    echo 'checked';
                                } ?> type='radio' name='type' value='2' required> Products
                        <input <?php if ($type == '3') {
                                    echo 'checked';
                                } ?> type='radio' name='type' value='3' required> Drinks
                        <input <?php if ($type == '4') {
                                    echo 'checked';
                                } ?> type='radio' name='type' value='4' required> Snacks
                        <input <?php if ($type == '5') {
                                    echo 'checked';
                                } ?> type='radio' name='type' value='5' required> Deserts
                    </td>
                </tr>
                <td colspan="2">
                    <input type='hidden' name='id' value='<?php echo $id ?>'>
                    <input type='submit' name='submit' value='Update Category' class="btn-secondary">
                </td>
            </table>
        </form>
        <?php
        if (isset($_GET['submit'])) {

            $id = $_GET['id'];
            $title = $_GET['title'];
            $type = $_GET['type'];

            $sql2 = "UPDATE category SET
                Category_name = '$title',
                id_type = '$type'
                WHERE id_category=$id
                ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2==true){
                $_SESSION['update'] = "<div class='success'>Category Updated Succsessfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else {
                $_SESSION['update'] = "<div class='error'>Failed To Update Category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>