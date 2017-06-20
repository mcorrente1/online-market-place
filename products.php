<?php

require("DatabaseConnection.php");
require("Product.php");

$db = new DatabaseConnection();

/* products.php
Stores info for products
*/

//pull product info from database and initialize products array
if (!$result = $db->queryDB("select * from products;")) {
    die ('There was an error running query[' . $connection->error . ']');
}
else {



    while ($row = $result->fetch_array()) {
        $product = new Product();
        $product->setName($row["name"]);
        $product->setDesc($row["description"]);
        $product->setPrice($row["price"]);
        $product->setImagePath($row["imagePath"]);
        $product->setProductId($row["productId"]);
        $products[$product->getProductId()] = $product;
    }

}

//$products = array(
//	1 => array(
//		'name' => 'Sneakers',
//		'price' => 24.99,
//		'category' => 'Shoes',
//		'description' => 'Black sneakers. Good for walking or athletic activity'
//	),
//	2 => array(
//		'name' => 'Armani Red Silk Shirt',
//		'price' => 379.99,
//		'category' => 'Shirts',
//		'description' => 'Fancy Italian red silk shirt. Very spiffy. Sure to attract the ladiez'
//	),
//	3 => array(
//		'name' => 'Samsung Constellation S17',
//		'price' => 1399.99,
//		'category' => 'Cell Phones',
//		'description' => 'The latest smartphone from Samsung. Features mind reading to know what you\'re thinking before you think it,
//			and send this information to advertisers to display relevant content of interest to you! Also new is a 3D holoraphic display with
//			motion control, so you can interact with virtual objects in real space.'
//	)
//);