  <?php include('partials/menu.php'); ?>
  <div class='main-content'>
      <div class='wrapper'>
          <h1 id='dashboard'>Update Order</h1>

          <br /><br /><br />
          <?php


            if (isset($_GET['id'])) {

                $id = $_GET['id'];

                $sql = "SELECT * FROM theorder, customer, product, status WHERE theorder.id_customer = customer.id_customer 
                AND theorder.id_status = status.id_status AND theorder.id_product = product.id_product AND theorder.id_order = $id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count == 1) {

                    $row = mysqli_fetch_assoc($res);

                    $id = $row['id_order'];
                    $product = $row['Product_name'];
                    $price = $row['Price'];
                    $qty = $row['Sum'] / $price;
                    $total = $row['Sum'];
                    $date = $row['Date'];
                    $customer_fname = $row['First_Name'];
                    $customer_lname = $row['Last_Name'];
                    $phone = $row['Phone_number'];
                    $adress = $row['Adress'];
                    $status = $row['Status_name'];
                    $old_status = $row['id_status'];
                    $customer_id = $row['id_customer'];
                } else {

                    header('location:' . SITEURL . 'admin/manage-order.php');
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }

            ?>
          <form action="" method="POST">
              <table class="tbl-30">
                  <tr>
                      <td>Product Name</td>
                      <td> <b><?php echo $product; ?></b></td>
                  </tr>
                  <tr>
                      <td>Qty</td>
                      <td>
                          <input type="number" name="qty" min="1" required value="<?php echo $qty; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>Status</td>
                      <td>
                          <select name="status">
                              <?php

                                $sql = "SELECT * FROM status";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);


                                if ($count > 0) {

                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['Status_name'];
                                        $category_id = $row['id_status'];

                                ?>
                                      <option <?php if ($old_status == $category_id) {
                                                    echo "selected";
                                                } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                              <?php
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                                ?>
                          </select>
                      </td>
                  </tr>
                  <tr>
                      <td>Price: </td>
                      <td>
                          <input type="text" name="price" value="<?php echo $price; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>Customer Fisrt Name: </td>
                      <td>
                          <input type="text" name="fname" value="<?php echo $customer_fname; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>Customer Last Name: </td>
                      <td>
                          <input type="text" name="lname" value="<?php echo $customer_lname; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>Customer Contact: </td>
                      <td>
                          <input type="text" name="pnumber" value="<?php echo $phone; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>Customer Address: </td>
                      <td>
                          <input type="text" name="adress" value="<?php echo $adress; ?>"></textarea>
                      </td>
                  </tr>

                  <tr>
                      <td clospan="2">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="price" value="<?php echo $price; ?>">

                          <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                      </td>
                  </tr>
              </table>
          </form>
          <?php


            if (isset($_POST['submit'])) {


                $qty = $_POST['qty'];

                $total = $price * $qty;

                $order_date = date("Y-m-d h:i:sa");

                $status = $_POST['status'];

                $customer_fname = $_POST['fname'];
                $customer_lname = $_POST['lname'];
                $customer_contact = $_POST['pnumber'];
                $customer_address = $_POST['adress'];



                $sql2 = "UPDATE customer SET 
                        First_Name = '$customer_fname',
                        Last_Name = '$customer_lname',
                        Phone_Number ='$customer_contact'
                        WHERE id_customer =$customer_id
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

                $sql4 = "UPDATE theorder SET 
                Date ='$order_date',
                Price = $price,
                id_status = $status,
                Adress='$customer_address',
                Sum = $total
                WHERE id_order = $id
            ";
                $res4 = mysqli_query($conn, $sql4);


                if ($res4 == true) {

                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed To Update Order</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            ?>
      </div>
  </div>

  <?php include('partials/footer.php'); ?>