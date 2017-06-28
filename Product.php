<?php

/**
 * Class Name: Product
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to manage a product.  It contains basic functionality to get and set all attributes and
 * two to display the products in HTML (one for a basic product listing and the other for a more specific view that alows
 * you to add the item to a shopping cart)
 * Explanation of important functions: This class is very basic. Outside of getters and setters, the display functions
 * are the only other ones.  They simply output a product as either an HTML paragraph or table row element.
 * Important data structures: None
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

#todo make a singleton
class Product
{
    private $name;
    private $desc;
    private $imagePath;
    private $price;
    private $productId;

    public function getDesc(){
        return $this->desc;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setDesc($desc){
        $this->desc = $desc;
    }

    public function setImagePath($imagePath){
        $this->imagePath = $imagePath;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setProductId($id)
    {
        $this->productId = $id;
    }

    #todo decide how this will work, should maybe put quantity forum outside of method?
    //used to after user clicks on a product, this function provides ability to add to cart??
    public function viewProduct(){
        // Display product
        echo "<p>
			<span style='font-weight:bold;'>" . $this->getName() . "</span><br />
			<span><img src=".$this->getImagePath()." alt=". $this->getName() ."height='700' width='500'\"></span><br/>
			<span>$" . $this->getPrice() . "</span><br />
			<span>" . $this->getDesc() . "</span><br />
			<p>
				<form action='./index.php?view_product=".$this->getProductId()." method='post'>
					<input name='quantity' type='number' min='1' value='1' required>
					<input type='hidden' name='product_id' value=" . $this->getProductId() . " />
					<input type='hidden' name='view_cart' value='TRUE' />
					<input type='submit' name='add_to_cart' value='Add to cart' />
				</form>
			</p>
		</p>";
    }

    public function display(){
        // TODO separate this from css
        // Display product
        #todo also make sure that hyperlink is correct
        echo "<tr>
			<td><img src=".$this->getImagePath()." alt=". $this->getName() ."height='304' width='228'\"></td>
			<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=". $this->getProductId() ."'>" . $this->getName() . "</a></td>
			<td style='border-bottom:1px solid #000000;'>$" . $this->getPrice() . "</td>
			<td style='border-bottom:1px solid #000000;'>" . $this->getDesc() . "</td>
		</tr>";


    }
}