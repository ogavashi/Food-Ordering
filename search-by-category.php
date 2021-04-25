<?php include('config/constants.php'); ?>
<?php
if (isset($_GET['id_category']) and isset($_GET['id_type']) and isset($_GET['Category_name'])) {
    $id_category = $_GET['id_category'];
    $id_type = $_GET['id_type'];
    $category_name = $_GET['Category_name'];

    $sql = "SELECT * FROM type WHERE id_type = $id_type";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $type_name = $row['Type_name'];
        }
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
    <title>Dungeon > <?php echo $category_name ?></title>
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
    <section>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="close-message">
                    <h1>Fill the form and we will call you</h1>
                    <span class="close">&times;</span>
                </div>
                <form class="fast-order">
                    <div class="vk">
                        <label for="fname">First name:</label>
                        <input class="input-text" type="text" id="fname" name="fname" />
                    </div>
                    <div class="vk">
                        <label for="lname">last name:</label>
                        <input class="input-text" type="text" id="lname" name="lname" />
                    </div>
                    <div class="vk">
                        <label for="pnumber">Phone number:</label>
                        <input class="input-text" type="text" id="pnumber" name="pnumber" />
                    </div>
                    <label for="clientOrder">What's your interest?<br /></label>
                    <div class="text-area">
                        <textarea class="text-a" name="clientOrder" cols="60" rows="4" aria-required="true" aria-invalid="false">
              </textarea>
                    </div>
                    <input class="submit-fast" type="submit" value="Send" name="submit" />
                </form>
            </div>
        </div>
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
                            <span> <?php echo $type_name ?> </span>
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="category-page-title">
                <strong><?php echo $category_name ?></strong>
            </h1>
        </div>
        <div class="filters-and-search">
            <span class="category-filters">
                <div class="filters-category">
                    <div>
                        <div class="filters">
                            <?php
                            $sql1 = "SELECT * FROM category WHERE id_type = $id_type";

                            $res1 = mysqli_query($conn, $sql1);

                            $count1 = mysqli_num_rows($res1);

                            if ($count1 > 0) {
                                while ($row = mysqli_fetch_assoc($res1)) {
                                    $id = $row['id_category'];
                                    $title = $row['Category_name'];
                                    $id_type = $row['id_type'];
                                    $category_name = $row['Category_name'];
                            ?>
                                    <a class="filters-filter" href="<?php echo SITEURL; ?>search-by-category.php?id_category=<?php echo $id ?>&id_type=<?php echo $id_type ?>&Category_name=<?php echo $category_name ?>">
                                        <h2 class="filter-title"><?php echo $title ?></h2>
                                    </a>
                            <?php
                                }
                            } else {
                                echo "<div class='error'>Wow, such empty :( </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </span>
        </div>
        <div id="best-food">
            <div class="products-list">
                <?php
                $sql2 = "SELECT * FROM product WHERE id_category = $id_category";

                $res2 = mysqli_query($conn, $sql2);

                $count = mysqli_num_rows($res2);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
                        $id = $row['id_product'];
                        $title = $row['Product_name'];
                        $image_name = $row['Img_ref'];
                        $description = $row['Description'];
                        $price = $row['Price'];
                ?>
                        <div class="full-card">
                            <div class="card">
                                <img src="/images/food/<?php echo $image_name ?>" alt="Tartar" style="width: 100%" />
                                <div class='info'>
                                    <h1><?php echo $title ?></h1>
                                    <p class="price">$<?php echo $price ?></p>
                                    <p>
                                        <?php echo $description ?>
                                    </p>
                                </div>
                            </div>
                            <div class="add-to-div">
                                <button onclick="window.location.href='<?php echo SITEURL; ?>order.php?product_id=<?php echo $id?>';" class="add-to-cart">Add to Cart</button>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='error'>Wow, such empty :( </div>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    if (isset($_GET['submit'])) {
        $first_name = $_GET['fname'];
        $last_name = $_GET['lname'];
        $phone_number = $_GET['pnumber'];
        $client_order = $_GET['clientOrder'];

        $sql = "INSERT INTO `fast-order` SET
             First_Name = '$first_name',
             Last_Name = '$last_name',
             Phonenumber = '$phone_number',
             Interest = '$client_order'
             ";
        echo $sql;
        $res = mysqli_query($conn, $sql) or die(mysqli_error('error'));

        if ($res == TRUE) {
            header('location:' . SITEURL . 'food.php');
        } else {
            header('location:' . SITEURL . 'food.php');
        }
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js/scipt.js" async defer></script>
</body>

</html>

<!-- <input id="search-field" type="text" placeholder="Search.." /> -->