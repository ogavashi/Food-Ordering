<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Manage Food</h1>
        <br /><br />
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class='btn-primary'> Add Food </a>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>

        <table class='tbl-full'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM product";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn=1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_product'];
                    $title = $row['Product_name'];
                    $price = $row['Price'];
                    $image_name = $row['Img_ref'];
            ?>
                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $price?></td>
                        <td><?php
                        if($image_name==''){
                            echo "<div class='error'>Image Not Added.</div>";
                        } 
                        else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                            <?php 


                        }
                        ?>
                        
                        </td>
                        <td>
                            <a href="#" class='btn-secondary'> Update Food </a>
                            <a href="#" class='btn-danger'> Delete Food </a>
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