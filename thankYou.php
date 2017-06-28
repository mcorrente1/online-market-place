<?php
    require_once("layout.php");
    require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Order Confirmation", $_SESSION['user']->getUserId());

?>

<h3>Thank you for your purchase!  A confirmation has been sent to your  email.</h3>

<?php
outputFooter(); ?>
