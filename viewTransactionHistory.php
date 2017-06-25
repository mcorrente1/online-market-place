<?php
require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Transaction History", $_SESSION['user']->getUserId());

echo "<h1>NOT IMPLEMENTED YET</h1>";


outputFooter();