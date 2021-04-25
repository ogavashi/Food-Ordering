<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1 id='dashboard'>Manage Order</h1>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br /><br /><br />

        <table class='tbl-full'>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Adress</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM theorder, customer, product, status WHERE theorder.id_customer = customer.id_customer 
                AND theorder.id_status = status.id_status AND theorder.id_product = product.id_product";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_order'];
                    $product = $row['Product_name'];
                    $price = $row['Price'];
                    $qty = $row['Sum'] / $price;
                    $total = $row['Sum'];
                    $date = $row['Date'];
                    $customer = $row['First_Name'] . ' ' . $row['Last_Name'];
                    $phone = $row['Phone_number'];
                    $adress = $row['Adress'];
                    $status = $row['Status_name'];
            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $product ?></td>
                        <td>$<?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td>$<?php echo $total ?></td>
                        <td><?php echo $date ?></td>
                        <td><?php echo $customer ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $adress ?></td>
                        <td><?php echo $status ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class='btn-secondary'> Update Order </a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='12' class='error'>No Orders Yet</td></tr>";
            }



            ?>

        </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>