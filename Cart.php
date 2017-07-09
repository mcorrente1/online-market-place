<?php
/**
 * Class Name: Cart
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to manage a customer the customer's shopping cart while they are browsing the
 * website. The user is able to add and remove items from their shopping cart
 * Explanation of important functions: The functions add or remove an item from the cart, update the cart, and check if * the cart is full
 * Important data structures: Dynamic array
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

require("CartItem.php");

class Cart
{
    private $shoppingCart = [];

    function addProduct($product, $quantity)
    {
        $cartItem = new CartItem($product, $quantity);
        $this->shoppingCart[$cartItem->getProductId()] = $cartItem;
    }

    function removeProduct($id)
    {
        unset($this->shoppingCart[$id]);
    }

    function updateQuantity($id, $newQuantity)
    {
        $this->shoppingCart[$id]->setQuantity($newQuantity);
    }

    function isInCart($id)
    {
        return array_key_exists($id, $this->shoppingCart);
    }

    public function isEmpty()
    {
        $strippedArray = array_filter($this->shoppingCart);
        return (empty($strippedArray));
    }

    public function getCart(){
        return $this->shoppingCart;
    }

    public function displayCart()
    {
        echo "<table style='width:500px;' cellspacing='0'>
				<tr>
					<th style='border-bottom:1px solid #000000;'>Name</th>
					<th style='border-bottom:1px solid #000000;'>Price</th>
					<th style='border-bottom:1px solid #000000;'>Quantity</th>
				</tr>";
        foreach ($this->shoppingCart as $cartItem) {

            echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=" . $cartItem->getProductId() . "'>" .
                $cartItem->displayProduct() . "</a></td>
						
					</tr>";
        }

        echo "</table>";
    }

}