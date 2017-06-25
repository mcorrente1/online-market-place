<?php
    require_once("layout.php");
    require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Home", $_SESSION['user']->getUserId());

outputFooter();