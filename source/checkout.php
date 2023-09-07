<?php
session_start();

require_once "connect/connectDB.php";

$items = array();
$grand_total = 0;

$sql = "SELECT product_name, quantity, total_price, flavor FROM tb_cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row;
}

// Convert the items array to JSON
$items_json = json_encode($items);

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Giỏ hàng</title>

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css" rel="stylesheet">

  <style>
    .error-msg {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }

    .error {
      border-color: red;
    }
  </style>
</head>

<body>

  <?php include "layout/header.php";?>

  <div class="">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
        <div class="container">
          <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Product(s)</th>
              <th>Flavor</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1;?>
            <?php foreach ($items as $item): ?>
              <tr>
                <td><?=$count?></td>
                <td><?=$item['product_name']?></td>
                <td><?=$item['flavor']?></td>
                <td><?=$item['quantity']?></td>
                <td><?=number_format($item['total_price'], 0)?></td>
              </tr>
              <?php $count++;?>
            <?php endforeach;?>
          </tbody>
          </table>
          <h5><b>Total Amount Payable:</b> <?=number_format($grand_total, 0)?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="user_id" value="<?=isset($user_id) ? $user_id : '';?>">
          <!-- Add this hidden input -->
          <input type="hidden" name="products" value="<?=$items_json;?>">
          <input type="hidden" name="grand_total" value="<?=$grand_total;?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
          </div>
          <div class="form-group">
            <input type="text" name="coupon_name" class="form-control" placeholder="Enter Coupon Code">
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10"
              placeholder="Enter Delivery Address Here..."></textarea>
          </div>
            <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <h6 class="text-center lead">Select Payment Mode</h6>
                <div class="form-group">
                <input type="hidden" name="payment_mode" id="payment-mode-input" value="cod">
                  <select name="pmode" class="form-control" id="payment-mode">
                    <option value="cod">Cash On Delivery</option>
                    <option value="paypal">PayPal</option>
                  </select>
                </div>
                <div id="paypal-button-container" style="display: none;"></div>
              </div>
            </div>
          </div>
            <script src="https://www.paypal.com/sdk/js?client-id=AaiK0St63FF408Ut2I_lM0WFlyGUs9Wz4O5QthU3dGilujAwRruek1xceLSycd9RXBTYsgLOjT-bkZOg&currency=USD"></script>
            <script>
              const grand_total = <?=$grand_total?>;

              // Get elements
              const paymentModeSelect = document.getElementById('payment-mode');
              const paypalButtonContainer = document.getElementById('paypal-button-container');
              const checkoutButton = document.getElementById('checkout-button');

              // Listen for payment mode change
              paymentModeSelect.addEventListener('change', function () {
                const selectedPaymentMode = paymentModeSelect.value;
                if (selectedPaymentMode === 'paypal') {
                  paypalButtonContainer.style.display = 'block';
                  checkoutButton.style.display = 'none';
                } else {
                  paypalButtonContainer.style.display = 'none';
                  checkoutButton.style.display = 'block';
                }
              });

              paypal.Buttons({
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            currency_code: "USD",
            value: grand_total
          }
        }]
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (orderData) {
        // Get transaction details from the PayPal response
        const transactionID = orderData.id;
        const payerName = orderData.payer.name.given_name + ' ' + orderData.payer.name.surname;
        const payerEmail = orderData.payer.email_address;
        
        // Get the selected payment mode
        const paymentMode = $('#payment-mode').val();

        // Send data to the server using AJAX, including payment mode
        $.ajax({
          url: 'handles_page/add_to_cart.php',
          method: 'post',
          data: {
            transactionID: transactionID,
            payerName: payerName,
            payerEmail: payerEmail,
            action: 'save_paypal_data',
            payment_mode: paymentMode, // Add payment mode to the data
          },
          success: function (response) {
            // Handle the server response if needed
            console.log(response);
          }
        });
      });
    }
  }).render('#paypal-button-container');
            </script>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include "layout/footer.php";?>

  <!-- script link -->
  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  <script src="public/frontend/assets/js/config.js"></script>
  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="public/frontend/assets/js/main.js?v=1.0.8"></script>
  <script src="public/myplugins/js/messagebox.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <!-- script link -->


  <script type="text/javascript">
    $(document).ready(function () {
      // Sending Form data to the server
       // Sending Form data to the server
  $("#placeOrder").submit(function (e) {
    e.preventDefault();

    // Lấy giá trị phương thức thanh toán
    const paymentMode = $("#payment-mode").val();

    // Thêm giá trị phương thức thanh toán vào dữ liệu form
    const formData = $('form').serialize() + "&action=order&pmode=" + paymentMode;

    $.ajax({
      url: 'handles_page/add_to_cart.php',
      method: 'post',
      data: formData,
      success: function (response) {
        $("#order").html(response);
        // window.location.href = "home.php";
      }
    });
  });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function (response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>