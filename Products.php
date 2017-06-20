<?php

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