<?php

require_once("Products.php");
require_once("Cart.php");
require("layout.php");
require("Customer.php");


if(!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = new User();
}

outputHeader("Store", $_SESSION['user']->getUserId());

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = new Products();
}

// Initialize cart
if(!isset($_SESSION['shopping_cart'])) {
	$_SESSION['shopping_cart'] = new Cart();
}

// Empty cart
if(isset($_GET['empty_cart'])) {
    unset($_SESSION['shopping_cart']);
	$_SESSION['shopping_cart'] = new Cart();
}

// **PROCESS FORM DATA**

$message = '';

// Add product to cart
if(isset($_GET['add_to_cart'])) {
	$product_id = $_GET['product_id'];

	// Check for valid item
	if(!$_SESSION['products']->checkExists($product_id)) {
		$message = "Invalid item!<br />";
	}
	// If item is already in cart, tell user
	else if($_SESSION['shopping_cart']->isInCart($product_id)) {
		$message = "Item already in cart!<br />";
	}
	// Otherwise, add to cart
	else {
        $_SESSION['shopping_cart']->addProduct($_SESSION['products']->getProduct($_GET['product_id']),$_GET['quantity'] );
		$message = "Added to cart!";
	}

}
// Update Cart
if(isset($_GET['update_cart'])) {

        if(!$_SESSION['shopping_cart']->isInCart($_GET['product_id'])) {
			$message = "Invalid product!";
		}
		$_SESSION['shopping_cart']->updateQuantity($_GET['product_id'],$_GET['quantity']);

	if(!$message) {
		$message = "Cart updated!<br />";
	}
}

// Remove from Cart
if(isset($_GET['remove_from_cart'])) {

    if(!$_SESSION['shopping_cart']->isInCart($_GET['product_id'])) {
        $message = "Invalid product!";
    }
    $_SESSION['shopping_cart']->removeProduct($_GET['product_id']);

    if(!$message) {
        $message = "Product Removed!<br />";
    }
}

// **DISPLAY PAGE**
echo $message;

// View a product
if(isset($_GET['view_product'])) {

	$product_id = $_GET['view_product'];

	if($_SESSION['products']->checkExists($product_id)) {
		// Display site links
		echo "<p>
			<a href='./index.php'>Back</a>";

		// Display product
		$_SESSION['products']->displayProductForPurchase($product_id);
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
		<a href='./index.php?view_cart=TRUE&empty_cart=1'>Empty Cart</a>
	</p>";

	if($_SESSION['shopping_cart']->isEmpty()) {
		echo "Your cart is empty.<br />";
	}
	else {
        $_SESSION['shopping_cart']->displayCart();
			echo "<p>
				<a href='./index.php?checkout=1'>Checkout</a>
			</p>";

	}
}
// Checkout
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

				#todo should we try not to return the shopping cart array?
				foreach($_SESSION['shopping_cart']->getCart() as $cartItem) {

					$total_price += $cartItem->getProductPrice() * $cartItem->getQuantity();
					echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=".$cartItem->getProductId()."'>" .
							$cartItem->getProductName(). "</a></td>
						<td style='border-bottom:1px solid #000000;'>$" . $cartItem->getProductPrice() . "</td>
						<td style='border-bottom:1px solid #000000;'>" . $cartItem->getQuantity() . "</td>
						<td style='border-bottom:1px solid #000000;'>$" . ($cartItem->getProductPrice() * $cartItem->getQuantity()) . "</td>
					  </tr>";
            $receipt .= $cartItem->getProductName() . "  $" .$cartItem->getProductPrice() . " x" . $cartItem->getQuantity() . " = $" . ($cartItem->getProductPrice() * $cartItem->getQuantity()) . "<br/>";
				}
			echo "</table>
			<p>Total price: $" . $total_price . "</p></form>";
      $receipt .=  "<br/>". "Total Price: $". $total_price;


        echo "<form action='billingInfo.php' method='POST'>
        <input type='hidden' name='launchParameter' value='initial'/>
        <input type='hidden' name='receipt' value='".$receipt."'/>
        <input type='submit' value='Billing Info'>
        </form>
        ";
	}
}
// View all products
else {
	// Display site links
	$_SESSION['products']->displayProducts();
}

outputFooter();
