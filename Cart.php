<?php

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