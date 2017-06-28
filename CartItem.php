<?php

require_once("Product.php");

# decorator for product class
class CartItem {

    private $product;
    private $quantity;

    public function __construct($productToAdd, $quantityOf)
    {
        $this->product = $productToAdd;
        $this->quantity = $quantityOf;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getProductId(){
        return $this->product->getProductId();
    }

    public function getProductName(){
        return $this->product->getName();
    }

    public function getProductPrice(){
        return $this->product->getPrice();
    }

    public function displayProduct()
    {
        echo "<tr>
			<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=". $this->product->getProductId() ."'>" . $this->product->getName() . "</a></td>
			<td style='border-bottom:1px solid #000000;'>$" . $this->product->getPrice() . "</td>
			<td><form action='./index.php? method='get'>
					<input name='quantity' type='number' min='1' value='".$this->getQuantity()."' required>
					<input type='hidden' name='product_id' value=" . $this->product->getProductId() . " />
					<input type='hidden' name='view_cart' value='TRUE' />
					<input type='submit' name='update_cart' value='Update' />
					<input type='submit' name='remove_from_cart' value='Remove' />
			</form></td>
		</tr>";
    }

}