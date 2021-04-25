<?php include('config/constants.php'); ?>
<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM product, category WHERE id_product=$product_id AND product.id_category=category.id_category";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $row = mysqli_fetch_assoc($res);

        $title = $row['Product_name'];
        $price = $row['Price'];
        $image_name = $row['Img_ref'];
        $category = $row['Category_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dungeon >Confirm Order</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style/secondary.css" />
    <link rel="icon" href="https://www.flaticon.com/svg/vstatic/svg/2830/2830305.svg?token=exp=1618155492~hmac=20052fcf63cb94c3ba7f443dd8dde1fd" />
</head>

<body>
    <header>
        <div class="top">
            <div class="logo">Dungeon</div>
            <div id="search">
                <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                    <input id="search-field" type="text" placeholder="Search.." name="search" />
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
            <button id="user-register">Order in one click</button>
        </div>
    </header>
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb__item">
                    <a href="<?php echo SITEURL; ?>index.php">
                        <span class="nav-title"> Main Page </span>
                    </a>
                    <i> > </i>
                </li>
                <li class="breadcrumb__item">
                    <a>
                        <span> Order </span>
                    </a>
                </li>
            </ol>
        </nav>
        <h1 class="category-page-title">
            <strong>Confirm Your Order</strong>
        </h1>
        <section>
            <form action="" method="POST">
                <div class='order-window'>
                    <div class='order-content'>
                        <h1 class='order-lable'>That looks tasty!</h1>
                        <section class='order-details'>
                            <div class='order-image'>
                                <img class='order-details-img' src="images/food/<?php echo $image_name ?>">
                            </div>
                            <div class='order-desc'>
                                <p class='order-product-name'><?php echo $title ?></p>
                                <div class='order-product-price'>
                                    <span class='price-itself'>
                                        <?php echo $price ?>$
                                    </span>
                                </div>
                                <div class='qty'>
                                    <span class='order-quantity'>
                                        Quantity:
                                    </span>
                                    <div>
                                        <input type="number" name="qty" class="input-qty" value="1" required>
                                    </div>
                                </div>
                                <div class='order-product-category'>
                                    <span class='product-category'>
                                        Category:
                                        <?php echo $category ?>
                                    </span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class='order-window'>
                    <div class='order-content'>
                        <h1 class='order-lable'>Delivery Details</h1>
                        <section class='order-details-delivery'>
                            <div class='order-detail'>
                                First Name:
                                <input type="text" name="fname">
                            </div>
                            <div class='order-detail'>
                                Last Name:
                                <input type="text" name="lname">
                            </div>
                            <div class='order-detail'>
                                Phone Number:
                                <input type="text" name="pnumber">
                            </div>
                            <div class='order-detail'>
                                Adress:
                                <input type="text" name="adress">
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Give it to me!" class='order-confirm-button'>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
            <?php


            if (isset($_POST['submit'])) {


                $qty = $_POST['qty'];

                $total = $price * $qty;

                $order_date = date("Y-m-d h:i:sa");

                $status = "1";

                $customer_fname = $_POST['fname'];
                $customer_lname = $_POST['lname'];
                $customer_contact = $_POST['pnumber'];
                $customer_address = $_POST['adress'];



                $sql2 = "INSERT INTO customer SET 
                        First_Name = '$customer_fname',
                        Last_Name = '$customer_lname',
                        Phone_Number ='$customer_contact'
                    ";

                $res2 = mysqli_query($conn, $sql2);

                $sql3 = "SELECT * from customer";
                $res3 = mysqli_query($conn, $sql3);

                $count = mysqli_num_rows($res3);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res3)) {
                        $id_user = $row['id_customer'];
                    }
                }

                $sql4 = "INSERT INTO theorder SET 
                id_product = '$product_id',
                Date ='$order_date',
                Price = $price,
                id_status = 1,
                Adress='$customer_address',
                Sum = $total,
                id_customer = $id_user
            ";
                $res4 = mysqli_query($conn, $sql4);


                if ($res4 == true) {

                    $_SESSION['order'] = "<div>Product Ordered Succsessfully</div>";
                    header('location:' . SITEURL);
                } else {
                    $_SESSION['order'] = "<div>Failed to Order Product</div>";
                    header('location:' . SITEURL);
                }
            }




            ?>
        </section>
    </div>
    </div>

    </section>


    </div>
</body>

</html>