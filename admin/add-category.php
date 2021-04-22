<?php include('partials/menu.php'); ?>


<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <br><br>
        <form action="" method="$_GET">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type='text' name='title' placeholder="Category Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Type:</td>
                    <td>
                        <input type='radio' name='type' value='1' required> Dishes
                        <input type='radio' name='type' value='2' required> Products
                        <input type='radio' name='type' value='3' required> Drinks
                        <input type='radio' name='type' value='4' required> Snacks
                        <input type='radio' name='type' value='5' required> Deserts
                    </td>
                </tr>
                <td colspan="2">
                    <input type='submit' name='submit' value='Add Category' class="btn-secondary">
                </td>
            </table>
        </form>
        <?php
        if (isset($_GET['submit'])) {
            $title = $_GET['title'];
            $type = $_GET['type'];

            $sql = "INSERT INTO category SET
            Category_name = '$title',
            id_type = '$type'
            ";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $_SESSION['add'] = "<div class='success'> Category Added Succsessfully</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'> Failed To Add Category</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>