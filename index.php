<?php
session_start();

require("products.php");
require("layout.php");

// Initialize cart
if(!isset($_SESSION['shopping_cart'])) {
	$_SESSION['shopping_cart'] = array();
}
// Empty cart
if(isset($_GET['empty_cart'])) {
	$_SESSION['shopping_cart'] = array();
}

// **PROCESS FORM DATA**

$message = '';

// Add product to cart
if(isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];

	// Check for valid item
	if(!isset($products[$product_id])) {
		$message = "Invalid item!<br />";
	}
	// If item is already in cart, tell user
	else if(isset($_SESSION['shopping_cart'][$product_id])) {
		$message = "Item already in cart!<br />";
	}
	// Otherwise, add to cart
	else {
		$_SESSION['shopping_cart'][$product_id]['product_id'] = $_POST['product_id'];
		$_SESSION['shopping_cart'][$product_id]['quantity'] = $_POST['quantity'];
		$message = "Added to cart!";
	}
}
// Update Cart
if(isset($_POST['update_cart'])) {
	$quantities = $_POST['quantity'];
	foreach($quantities as $id => $quantity) {
		if(!isset($products[$id])) {
			$message = "Invalid product!";
			break;
		}
		$_SESSION['shopping_cart'][$id]['quantity'] = $quantity;
	}
	if(!$message) {
		$message = "Cart updated!<br />";
	}
}


// **DISPLAY PAGE**
echo $header;

echo $message;

// View a product
if(isset($_GET['view_product'])) {
	$product_id = $_GET['view_product'];

	if(isset($products[$product_id])) {
		// Display site links
		echo "<p>
			<a href='./index.php'>Back</a>";


		// Display product
		echo "<p>
			<span style='font-weight:bold;'>" . $products[$product_id]->getName() . "</span><br />
			<span><img src=".$product->getImagePath()." alt=". $product->getName() ."height='700' width='500'\"></span><br/>
			<span>$" . $products[$product_id]->getPrice() . "</span><br />
			<span>" . $products[$product_id]->getDesc() . "</span><br />
			<p>
				<form action='./index.php?view_product=$product_id' method='post'>
					<input name='quantity' type='number' min='1' value='1' required>
					<input type='hidden' name='product_id' value='$product_id' />
					<input type='submit' name='add_to_cart' value='Add to cart' />
				</form>
			</p>
		</p>";
	}
	else {
		echo "Invalid product!";
	}
}
// View cart
else if(isset($_GET['view_cart'])) {
	// Display site links
	echo "<p>
		<a href='./index.php'>DropShop</a></p>";

	echo "<h3>Your Cart</h3>
	<p>
		<a href='./index.php?empty_cart=1'>Empty Cart</a>
	</p>";

	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?view_cart=1' method='post'>
		<table style='width:500px;' cellspacing='0'>
				<tr>
					<th style='border-bottom:1px solid #000000;'>Name</th>
					<th style='border-bottom:1px solid #000000;'>Price</th>
					<th style='border-bottom:1px solid #000000;'>Quantity</th>
				</tr>";
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $product['product_id'];

					echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=$id'>" .
							$products[$product_id]->getName() . "</a></td>
						<td style='border-bottom:1px solid #000000;'>$" . $products[$product_id]->getPrice() . "</td>
						<td style='border-bottom:1px solid #000000;'>
							<input type='number' name='quantity[$product_id]' value='" . $product['quantity'] . "' /></td>
					</tr>";
				}
			echo "</table>
			<input type='submit' name='update_cart' value='Update' />
			</form>
			<p>
				<a href='./index.php?checkout=1'>Checkout</a>
			</p>";

	}
}
// Checkount
else if(isset($_GET['checkout'])) {
	// Display site links
	echo "<p>
		<a href='./index.php'>DropShop</a></p>";

	echo "<h3>Checkout</h3>";

	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?checkout=1' method='post'>
		<table style='width:500px;' cellspacing='0'>
				<tr>
					<th style='border-bottom:1px solid #000000;'>Name</th>
					<th style='border-bottom:1px solid #000000;'>Item Price</th>
					<th style='border-bottom:1px solid #000000;'>Quantity</th>
					<th style='border-bottom:1px solid #000000;'>Cost</th>
				</tr>";

				$total_price = 0;
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $product['product_id'];


					$total_price += $products[$product_id]['price'] * $product['quantity'];
					echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=$id'>" .
							$products[$product_id]['name'] . "</a></td>
						<td style='border-bottom:1px solid #000000;'>$" . $products[$product_id]['price'] . "</td>
						<td style='border-bottom:1px solid #000000;'>" . $product['quantity'] . "</td>
						<td style='border-bottom:1px solid #000000;'>$" . ($products[$product_id]['price'] * $product['quantity']) . "</td>
					</tr>";
				}
			echo "</table>
			<p>Total price: $" . $total_price . "</p>";

	}
}
// View all products
else {
	// Display site links


	echo "<h3>Our Products</h3>";

	echo "<table style='width:500px;' cellspacing='0' >";

	// Loop to display all products
	foreach($products as $product) {
		// TODO separate this from css
		echo "<tr>
			<td><img src=".$product->getImagePath()." alt=". $product->getName() ."height='304' width='228'\"></td>
			<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=". $product->getProductId() ."'>" . $product->getName() . "</a></td>
			<td style='border-bottom:1px solid #000000;'>$" . $product->getPrice() . "</td>
			<td style='border-bottom:1px solid #000000;'>" . $product->getDesc() . "</td>
		</tr>";
	}
	echo "</table>";
}

echo $footer;

?>
