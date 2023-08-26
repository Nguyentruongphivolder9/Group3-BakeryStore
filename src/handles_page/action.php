<?php
session_start();
require '../connect/connection.php';

// Add products into the cart table
if (isset($_POST['pid'])) {
	$pid = $_POST['pid'];
	$pname = $_POST['pname'];
	$pprice = $_POST['pprice'];
	$pqty = $_POST['pqty'];
	$total_price = $pprice * $pqty;

	// Check if the product is already in the cart
	$stmt = $conn->prepare('SELECT product_id FROM tb_cart WHERE product_id=?');
	$stmt->bind_param('s', $pid);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows == 0) {
		// Product is not in the cart, add it
		$order_id = mt_rand(10000, 99999);
		$query = $conn->prepare('INSERT INTO tb_cart (product_id, order_id, quantity, total_price, product_name, price) VALUES (?,?,?,?,?,?)');
		$query->bind_param('iiiisi', $pid, $order_id, $pqty, $total_price, $pname, $pprice);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Item added to your cart!</strong>
		</div>';
	} else {
		// Product is already in the cart
		echo '<div class="alert alert-danger alert-dismissible mt-2">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Item already added to your cart!</strong>
		</div>';
	}
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $stmt = $conn->prepare('SELECT * FROM tb_cart');
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];

	$stmt = $conn->prepare('DELETE FROM tb_cart WHERE product_id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM tb_cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'All Item removed from the cart!';
	header('location:../cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['price'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE tb_cart SET quantity=?, total_price=? WHERE product_id=?');
	$stmt->bind_param('idi', $qty, $tprice, $pid);

	if ($stmt->execute()) {
		echo "success";
	} else {
		echo "Error updating quantity";
	}
	exit();
}



// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$products = $_POST['products'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];

	$data = '';

	$stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
	$stmt->bind_param('sssssss', $name, $email, $phone, $address, $pmode, $products, $grand_total);
	$stmt->execute();
	$stmt2 = $conn->prepare('DELETE FROM cart');
	$stmt2->execute();
	$data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	echo $data;
}
?>