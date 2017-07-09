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
 * Another important function is the display, which uses a foreach loop structure to output each product from the products
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

        echo "<table id='displayProductsTable' cellpadding='10' cellspacing='0' >";
        //echo "<p><button onclick='sortTable()'>Sort</button></p>";

        // Loop to display all products
        foreach($this->products as $product) {
           $product->display();
        }
        echo "</table>";
        echo "<script>
        function sortTable() {
          var table, rows, switching, i, x, y, shouldSwitch;
          table = document.getElementById('myTable');
          switching = true;
          /*Make a loop that will continue until no switching has been done:*/
          while (switching)
          {
              //start by saying: no switching is done:
              switching = false;
              rows = table.getElementsByTagName('TR');
              /*Loop through all table rows (except the first, which contains table headers):*/

              for (i = 1; i < (rows.length - 1); i++)
              {
                  //start by saying there should be no switching:
                  shouldSwitch = false;
                  /*Get the two elements you want to compare,
                  one from current row and one from the next:*/
                  x = rows[i].getElementsByTagName('TD')[0];
                  y = rows[i + 1].getElementsByTagName('TD')[0];
                  //check if the two rows should switch place:
                  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
                  {
                      //if so, mark as a switch and break the loop:
                      shouldSwitch= true;
                      break;
                  }
            }
            if (shouldSwitch)
            {
              /*If a switch has been marked, make the switch and mark that a switch has been done:*/
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
        }
      }</script>";
    }

}
