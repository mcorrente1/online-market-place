<?php
/**
 * Class Name: None
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This module allows the user to edit their account information
 * Explanation of important functions: None.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Edit Account", $_SESSION['user']->getUserId());

require_once("Customer.php");
require("DatabaseConnection.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET["success"])) {
    echo "Account successfully updated.<br/><br/>";
}

// define variables and set to empty values
$fNameErr = $lNameErr = $emailErr = $phoneNumErr = $addressErr = "";
$fName = $lName = $email = $phoneNum = $address  = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    #todo insert all error messages like so
    #else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    #$nameErr = "Only letters and white space allowed";
    #$isValid = false;
    #}

    if (empty($_POST["fName"])) {
        $fNameErr = "First name is required";
        $isValid = false;
    } else {
        $fName = test_input($_POST["fName"]);
    }
    if (empty($_POST["lName"])) {
        $lNameErr = "Last name is required";
        $isValid = false;
    } else {
        $lName = test_input($_POST["lName"]);
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $isValid = false;
    } else {
        $email = test_input($_POST["email"]);
    }
    if (empty($_POST["phoneNumber"])) {
        $phoneNumErr = "Phone number is required";
        $isValid = false;
    } else {
        $phoneNum = test_input($_POST["phoneNumber"]);
    }
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $isValid = false;
    } else {
        $address = test_input($_POST["address"]);
    }

    if($isValid){

        $db = new DatabaseConnection();

        if ($db->queryDB("UPDATE users SET firstName = '". $fName ."', lastName = '". $lName ."', email = '". $email ."', phone = '". $phoneNum ."', address = '". $address ."' WHERE userId = '".$_SESSION['user']->getUserId()."';")){

            # log in new user
            $result = $db->queryDB("SELECT * FROM users WHERE userId = '".  $_SESSION['user']->getUserId()."';");
            $row = $result->fetch_array();
            unset($_SESSION['user']);
            $_SESSION['user'] = new Customer($row['userId'], $row['firstName'], $row['lastName'], $row['email'], $row['address'], $row['phone']);
            header('Location:/online-marketplace/editAccount.php?success=TRUE');
        }
        else {
            #todo display error if something goes wrong
            print "error";
        }
    }//end isValid
}


echo "<form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='POST'>
 First Name:&emsp;<input type='text' name='fName' value='".$_SESSION['user']->getFirstName()."'><span style='color:red'>* ".$fNameErr."</span><br><br>
 Last Name:&emsp;<input type='text' name='lName' value='".$_SESSION['user']->getLastName()."'><span style='color:red'>* ".$lNameErr."</span><br><br>
 Email:&emsp;<input type='text' name='email' value='".$_SESSION['user']->getEmail()."'><span style='color:red'>* ".$emailErr."</span><br><br>
 Address:&emsp;<input type='text' name='address' value='".$_SESSION['user']->getAddress()."'><span style='color:red'>* ".$addressErr."</span><br><br>
 Phone Number:&emsp;<input type='text' name='phoneNumber' value='".$_SESSION['user']->getPhoneNumber()."'><span style='color:red'>* ".$phoneNumErr." </span><br><br>
<input type='submit' name='submit' value='Submit'>
 </form> ";


outputFooter();