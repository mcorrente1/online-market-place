<!DOCTYPE HTML>
<html>
<body>

<?php

require("DatabaseConnection.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// define variables and set to empty values
$fNameErr = $lNameErr = $emailErr = $passwordErr = $confirmPasswordErr = $phoneNumErr = $addressErr = "";
$fName = $lName = $email = $password = $confirmPassword = $phoneNum = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isValid = true;

    if (empty($_POST["fName"])) {
        $fNameErr = "First name is required";
        $isValid = false;
    } else {
        $fName = test_input($_POST["fName"]);
    }

    #todo insert all error messages like so
    #if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        #$nameErr = "Only letters and white space allowed";
        #$isValid = false;
    #}

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

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $isValid = false;
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Confirm password is required";
        $isValid = false;
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);

        if (strcmp($password, $confirmPassword) != 0) {
            $confirmPasswordErr = "Passwords do not match";
            $isValid = false;
        }
    }

    if (empty($_POST["phoneNum"])) {
        $phoneNumErr = "Phone number is required";
        $isValid = false;
    } else {
        $phoneNum = test_input($_POST["phoneNum"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $isValid = false;
    } else {
        $address = test_input($_POST["address"]);
    }

    if($isValid){
        #todo insert data into user table through mysqli query command
        # $db = new DatabaseConnection();

        echo "VALID!!!!!";
    }

}
?>

<span style="color:red">* required field.</span><br><br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <input type="text" name="fName" placeholder="First Name" value="<?php echo $fName; ?>"><span style="color:red">* <?php echo $fNameErr;?></span><br><br/>
    <input type="text" name="lName" placeholder="Last Name" value="<?php echo $lName; ?>"><span style="color:red">* <?php echo $lNameErr;?></span><br><br/>
    <input type="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>"><span style="color:red">* <?php echo $emailErr;?></span><br><br/>
    <input type="password" name="password" placeholder="Password"><span style="color:red">* <?php echo $passwordErr;?></span><br><br/>
    <input type="password" name="confirmPassword" placeholder="Confirm Password"><span style="color:red">* <?php echo $confirmPasswordErr;?></span><br><br/>
    <input type="tel" name="phoneNum" placeholder="Phone Number" value="<?php echo $phoneNum; ?>"><span style="color:red">* <?php echo $phoneNumErr;?></span><br><br/>
    <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>"add><span style="color:red">* <?php echo $addressErr;?></span><br><br/>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
