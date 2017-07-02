<?php
/**
 * Class Name: None
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This module displays the user’s past purchases
 * Explanation of important functions: None.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

require_once("layout.php");
require_once("Customer.php");
require_once("DatabaseConnection.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Transaction History", $_SESSION['user']->getUserId());

$db = new DatabaseConnection();

if ($result = $db->queryDB("SELECT * FROM receipts where userId = '".$_SESSION['user']->getUserId()."' ;")) {
    while ($row = $result->fetch_array()) {
        echo "--------------------------------------------------------";
        echo "<br/>";
        echo "Date of Transaction: " . $row['date'];
        echo "<br/><br/>";
        echo $row['contents'];
        echo "<br/>";
        echo "--------------------------------------------------------";
        echo "<br/>";
        echo "<br/>";
    }

}


outputFooter();