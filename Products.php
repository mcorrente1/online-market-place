<?php

/**
 * Class Name: Products
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to manage an array of product objects. The array is initialized by querying a remote
 * database and instantiating objects based on the queried product data.
 * Explanation of important functions: The most important function in this class is the constructor.  There are no parameters
 * to be passed in. First, a connection to the database is created and then a query is sent to select everything from
 * the PRODUCTS table. Every returned row is looped through and product objects are then instantiated and added to the
 * products array to the location based on their product id.
 * Another important function is the display, which uses a foreach loop structure to output each product in the products
 * array to an HTML table.
 * Important data structures: Array-used to manage all of the products
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required
*/

require("DatabaseConnection.php");
require("Product.php");


class Products{

    private $products;

    function __construct()
    {
        $db = new DatabaseConnection();

        //pull product info from database and initialize products array
        if (!$result = $db->queryDB("select * from products;")) {
            die ('There was an error running query[' . $db->error . ']');
        } else {

            while ($row = $result->fetch_array()) {
                $product = new Product();
                $product->setName($row["name"]);
                $product->setDesc($row["description"]);
                $product->setPrice($row["price"]);
                $product->setImagePath($row["imagePath"]);
                $product->setProductId($row["productId"]);
                $this->addProduct($product);
            }
        }

        $db->disconnect();
    }


    private function addProduct($productToAdd){
        $this->products[$productToAdd->getProductId()] = $productToAdd;
    }

    public function getProduct($productId){
            return $this->products[$productId];
    }

    public function checkExists($productId){
        return isset($this->products[$productId]);
    }


    #todo correct this functionality and make sure adding quantity works
    function displayProductForPurchase($productId){
        $this->getProduct($productId)->viewProduct();
    }


    function displayProducts()
    {

        echo "<table style='width:500px;' cellspacing='0' >";

        // Loop to display all products
        foreach($this->products as $product) {
           $product->display();
        }
        echo "</table>";
    }

}