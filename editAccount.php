<?php
require_once("layout.php");


echo $header;

if(!isset($_SESSION)) {
    session_start();
}

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
$fNameErr = $lNameErr = $emailErr = $phoneNumErr = $addressErr = $creditCardErr = "";
$fName = $lName = $email = $phoneNum = $address = $creditCard = "";
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
//    if (empty($_POST["creditCard"])) {
//        $creditCardErr = "Credit Card is required";
//        $isValid = false;
//    } else {
//        $creditCard = test_input($_POST["creditCard"]);
//    }
    if (empty($_POST["creditCard"])) {  #todo maybe not handle users credit card info
        $creditCard = "";

    } else {
        $creditCard = test_input($_POST["creditCard"]);
    }

    if($isValid){

        $db = new DatabaseConnection();

        if ($db->queryDB("UPDATE users SET firstName = '". $fName ."', lastName = '". $lName ."', creditCard = '". $creditCard ."', email = '". $email ."', phone = '". $phoneNum ."', address = '". $address ."' WHERE userId = '".$_SESSION['user']->getUserId()."';")){

            # log in new user
            $result = $db->queryDB("SELECT * FROM users WHERE userId = '".  $_SESSION['user']->getUserId()."';");
            $row = $result->fetch_array();
            unset($_SESSION['user']);
            $_SESSION['user'] = new Customer($row['userId'], $row['firstName'], $row['lastName'], $row['creditCard'], $row['email'], $row['address'], $row['phone']);
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
 CreditCard:&emsp;<input type='text' name='creditCard' value='".$_SESSION['user']->getCreditCard()."'><span style='color:red'>* " .$creditCardErr. "</span><br><br>
<input type='submit' name='submit' value='Submit'>
 </form> ";


echo $footer;