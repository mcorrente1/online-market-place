<?php

/**
 * Created by PhpStorm.
 * User: mattcorrente
 * Date: 6/19/17
 * Time: 12:44 PM
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

    #todo decide how this will work, should maybe put forum outside of method?
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