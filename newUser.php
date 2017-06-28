<?php

require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Create Account", $_SESSION['user']->getUserId());

if(!isset($_SESSION)) {
    session_start();
}

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
    // define variables and set to empty values
    $fNameErr = $lNameErr = $emailErr = $passwordErr = $confirmPasswordErr = $phoneNumErr = $addressErr = "";
    $fName = $lName = $email = $password = $confirmPassword = $phoneNum = $address = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = true;
        if (empty($_POST["fName"])) {
            $fNameErr = "First name is required";
            $isValid = false;
        } elseif (!preg_match("/^[^0-9!@#$%^&*()\-_=+]*[a-zA-Z]+[^0-9!@#$%^&*()\-_=+]*$/", $_POST["fName"])) {
            $fNameErr = "Can only contain letters; No numbers or special characters";
            $isValid = false;
        } else {
            $fName = test_input($_POST["fName"]);
        }
        if (empty($_POST["lName"])) {
            $lNameErr = "Last name is required";
            $isValid = false;
        } elseif(!preg_match("/^[^0-9!@#$%^&*()\-_=+]*[a-zA-Z]+[^0-9!@#$%^&*()\-_=+]*$/", $_POST["lName"])) {
            $lNameErr = "Can only contain letters; No numbers or special characters";
            $isValid = false;
        } else {
            $lName = test_input($_POST["lName"]);
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isValid = false;
        } elseif(!preg_match("/^[a-zA-Z]++[0-9a-zA-Z]*+[@][a-zA-Z]++[.](com|net|org)$/", $_POST["email"])) {
            $emailErr = "Email must be valid";
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
        }
        /* phone number pattern allows for any combo of the following formats: (xxx) xxx-xxxx;
         xxxxxxx; xxx-xxx-xxxx; xxx xxx xxxx */
        elseif(!preg_match("/^[(]*[0-9]{3}[)\- ]*+[0-9]{3}[- ]*+[0-9]{4}$/", $_POST["phoneNum"])) {
            $phoneNumErr = "Not a valid phone number";
            $isValid = false;
        } else {
            $phoneNum = test_input($_POST["phoneNum"]);
        }
        if (empty($_POST["address"])) {
            $addressErr = "Address is required";
            $isValid = false;
        }
        /* address pattern allows users to enter commas, or just spaces; address does need
        to end with 2 consecutive letters, followed by 5 consecutive digits (for state, zip--code) */
//        elseif(!preg_match("/^[0-9]+[ #.0-9a-zA-Z]+[,]*[ a-zA-Z]+[, ]*[a-zA-Z]{2}[ ][0-9]{5}$/", $_POST["address"])) {
//            $addressErr = "Not a valid address";
//            $isValid = false;
//        }
        else {
            $address = test_input($_POST["address"]);
        }

        if($isValid){

            $db = new DatabaseConnection();

            # check if email is unique
            $result = $db->queryDB("SELECT * from users WHERE email = '".$email."';");

            if ($result && $result->num_rows == 1) {
                $emailErr = "An account is already registered with this email";
                $isValid = false;
            }
            else {

                if ($db->queryDB("INSERT INTO users (firstName, lastName, email, password, phone, address) VALUES ('" . $fName . "', '" . $lName . "', '" . $email . "', '" . $password . "', '" . $phoneNum . "', '" . $address . "');")) {
                    unset($_SESSION['user']);
                    $result = $db->queryDB("select userId from users where email = '. $email .' and password = ' $password';");
                    $row = $result->fetch_array();
                    $_SESSION['user'] = new Customer($row['userId'], $fName, $lName, "", $email, $address, $phoneNum);
                    header('Location:/online-marketplace/index.php');
                }
            }
        }//end isValid
    }
    ?>
    <div id="userForm">
    <span style="color:red">* required field.</span><br><br/>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="text" name="fName" placeholder="First Name" value="<?php echo $fName; ?>">* <?php echo $fNameErr;?><br><br/>
        <input type="text" name="lName" placeholder="Last Name" value="<?php echo $lName; ?>">* <?php echo $lNameErr;?><br><br/>
        <input type="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>">* <?php echo $emailErr;?><br><br/>
        <input type="password" name="password" placeholder="Password">* <?php echo $passwordErr;?><br><br/>
        <input type="password" name="confirmPassword" placeholder="Confirm Password">* <?php echo $confirmPasswordErr;?><br><br/>
        <input type="tel" name="phoneNum" placeholder="Phone Number" value="<?php echo $phoneNum; ?>">* <?php echo $phoneNumErr;?><br><br/>
        <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">* <?php echo $addressErr;?><br><br/>
        <input type="submit" name="submit" value="Submit">
    </form>
    </div>
    <div id="userForm2">
    <form action='login.php' method='POST'><br><br>Already have an account?<br><input type='submit' value='Click Here'> to sign in.
    </form>
    </div>

<?php
outputFooter();

