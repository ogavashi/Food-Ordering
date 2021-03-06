<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Dungeon</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="icon" href="https://www.flaticon.com/svg/vstatic/svg/2830/2830305.svg?token=exp=1618155492~hmac=20052fcf63cb94c3ba7f443dd8dde1fd" />
</head>

<body>
  <header>
    <div class="container cols">
      Dungeon
      <?php
      if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
      }
      ?>
      <button id="user-register">Order in one click</button>
    </div>
  </header>
  <section>
    <div class="quote">
      <span class="top-phrase"> Giving your Hunger a new Option</span>
      <div id="search">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
          <input id="search-field" type="text" placeholder="Search.." name="search" />
          <button type="submit" name="submit">Submit</button>
        </form>
      </div>
    </div>
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
    <div id="categories">
      <button onclick="window.location.href='<?php echo SITEURL; ?>food.php';" class="round-button">
        <div class="category">
          <img class="category-img" src="https://res.cloudinary.com/glovoapp/w_140,h_140,c_fit,f_auto,q_auto/StoreCategories/prj0mlcuvmymzfh8pqjz" />
          <h2 ??lass="category-name">Dishes</h2>
        </div>
      </button>
      <button onclick="window.location.href='<?php echo SITEURL; ?>drinks.php';" class="round-button">
        <img class="category-img" src="https://res.cloudinary.com/glovoapp/w_140,h_140,c_fit,f_auto,q_auto/StoreCategories/ft4i1ieyeatqfoqd4pdc" />
        <h2 ??lass="category-name">Drinks</h2>
      </button>
      <button onclick="window.location.href='<?php echo SITEURL; ?>products.php';" class="round-button">
        <img class="category-img" src="https://res.cloudinary.com/glovoapp/w_140,h_140,c_fit,f_auto,q_auto/StoreCategories/pdnz24ln2tb5ia4268bk" />
        <h2 ??lass="category-name">Products</h2>
      </button>
      <button onclick="window.location.href='<?php echo SITEURL; ?>snacks.php';" class="round-button">
        <img class="category-img" src="https://res.cloudinary.com/glovoapp/w_140,h_140,c_fit,f_auto,q_auto/StoreCategories/tprz7khmhksz4xrj7ufc" />
        <h2 ??lass="category-name">Snacks</h2>
      </button>
      <button onclick="window.location.href='<?php echo SITEURL; ?>deserts.php';" class="round-button">
        <img class="category-img" src="https://res.cloudinary.com/glovoapp/w_140,h_140,c_fit,f_auto,q_auto/StoreCategories/vevdez89piflyonld84d" />
        <h2 ??lass="category-name">Deserts</h2>
      </button>
    </div>
    <div id="best-food">
      <span>Best dishes this week. Choose what you like</span>
      <div class="products-list">
        <div class="full-card">
          <div class="card">
            <img src="https://eshop.kolkovna.sk/webcare/image/BFLEAAAABAYjBjZGRiZmU1OWM0N2ViNmE5OWQ2ORRXydZ5eoPMvdu7ENqAdgcnOI" alt="Tartar" style="width: 100%" />
            <h1>Tartar</h1>
            <p class="price">$14.99</p>
            <p>
              Finely scraped beef sirloin seasoned to the best of our knowledge and belief, served
              with garlic toasts
            </p>
          </div>
        </div>
        <div class="full-card">
          <div class="card">
            <img src="https://eshop.kolkovna.sk/webcare/image/BFLEAAAAEQYWZkMTM3NDBhMmJhNjQyNjYzNTFstb4r2zOxj86FJID97KtCPflrRm" alt="Wings" style="width: 100%" />
            <h1>Hot Wings</h1>
            <p class="price">$9.99</p>
            <p>
              Chicken wings in a spicy marinade, with roasted corn, corn tortillas, cheese and
              barbecue sauce
            </p>
          </div>
        </div>
        <div class="full-card">
          <div class="card">
            <img src="https://eshop.kolkovna.sk/webcare/image/BFLEAAAABgNWM1NGZmMzJhMGYxOTk1MjE3NTl12DJ67k7SlOJuA0o5MXLBniJvk4" alt="Cesar" style="width: 100%" />
            <h1>Cesar</h1>
            <p class="price">$6.99</p>
            <p>
              Romaine lettuce leaves with grilled chicken breast, bacon, croutons and anchovies
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="footer-container">
      <div class="footer-links">
        <div class="footer-headline">Our Social Networks</div>
        <a class="footer-links-link" target="_blank" href="https://www.facebook.com/profile.php?id=100008021058038"> FaceBook </a>
        <a class="footer-links-link" target="_blank" href="https://www.instagram.com/"> Instagram </a>
        <a class="footer-links-link" target="_blank" href="https://twitter.com/zelenskyyua"> Twitter </a>
      </div>
      <div class="footer-links">
        <div class="footer-headline">Useful links</div>
        <a class="footer-links-link" href="#"> About Us </a>
        <a style="width: 120px" class="footer-links-link" href="#"> Regular Questions </a>
        <a class="footer-links-link" href="#"> Contacts </a>
      </div>
    </div>
    <span class="footer-madeBy"> Designed and made by OG </span>
  </footer>
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
      header('location:' . SITEURL . 'index.php');
    } else {
      header('location:' . SITEURL . 'index.php');
    }
  }
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="script.js/scipt.js" async defer></script>
</body>

</html>