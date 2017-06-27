<?php
require_once("layout.php");
require_once("DatabaseConnection.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

outputHeader("Billing Info", $_SESSION['user']->getUserId());

# check if user is logged in, if not prompt to log in or continue as guest, if so
# then auto fill form with their account info
if($_POST['launchParameter'] == 'initial'){
    $_SESSION['receipt'] = $_POST['receipt'];
}

if($_POST['launchParameter'] == 'initial' && $_SESSION['user']->getUserId() == -1){
    if($_SESSION['user']->getUserId() == -1){
        echo "<form action='billingInfo.php' method='POST'>
        <input type='hidden' name='launchParameter' value='continueAsGuest'/>
        <input type='submit' value='Continue As Guest'>
        </form>
        ";

        echo "<form action='login.php' method='POST'>
        <input type='submit' value='Log In'>
        </form>
        ";
    }
}
else {

    // define variables and set to empty values
    $fNameErr = $lNameErr = $emailErr = $phoneNumErr = $addressErr = $creditCardErr = $cvvErr = $passwordErr = $confirmPasswordErr = "";
    $fName = $lName = $email = $phoneNum = $address = $creditCard = $cvv = $password = $confirmPassword = "";


    if ($_POST['launchParameter'] == 'initial') {

        $fName = $_SESSION['user']->getFirstName();
        $lName = $_SESSION['user']->getLastName();
        $email = $_SESSION['user']->getEmail();
        $address = $_SESSION['user']->getAddress();
        $phoneNum = $_SESSION['user']->getPhoneNumber();
        $creditCard = $_SESSION['user']->getCreditCard();
    }


    if ($_POST['launchParameter'] == 'onSubmit') {

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
        if (empty($_POST["creditCard"])) {
            $creditCardErr = "Credit Card is required";
            $isValid = false;

        } else {
            $creditCard = test_input($_POST["creditCard"]);
        }

        if (empty($_POST["cvv"])) {
            $cvvErr = "CVV is required";
            $isValid = false;

        } else {
            $cvv = test_input($_POST["cvv"]);
        }

        if (isset($_POST['createAccount'])) {
            //echo "user wants to create an account;  need to prompt for password somehow";
            if (empty($_POST["password"])) {
                $passwordErr = "Password is required to create account";
                $isValid = false;
            } else {
                $password = test_input($_POST["password"]);

                if (empty($_POST["confirmPassword"])) {
                    $confirmPasswordErr = "Passwords do not match";
                    $isValid = false;
                } else {
                    $confirmPassword = test_input($_POST["confirmPassword"]);
                    if (strcmp($password, $confirmPassword) != 0) {
                        $confirmPasswordErr = "Passwords do not match";
                        $isValid = false;
                    }
                }
            }
        }

        if ($isValid) {

            $db = new DatabaseConnection();

            #check if user was a guest
            if ($_SESSION['user']->getUserId() == -1) {
                #check if guest wants to create an account, if so then create the account and log them in
                if (isset($_POST['createAccount'])) {

                    # check if email is unique
                    $result = $db->queryDB("SELECT * from users WHERE email = '" . $email . "';");

                    if ($result && $result->num_rows == 1) {
                        $emailErr = "An account is already registered with this email";
                        $isValid = false;
                    } else {

                        $db->queryDB("INSERT INTO users (firstName, lastName, email, password, phone, address) VALUES ('" . $fName . "', '" . $lName . "', '" . $email . "', '" . $password . "', '" . $phoneNum . "', '" . $address . "');");
                        unset($_SESSION['user']);
                        if ($result = $db->queryDB("SELECT userId FROM users WHERE email = '$email' AND password = '$password';")) {
                            $row = $result->fetch_array();
                            #select userId from  users where email = 'asdf' and password = 'asdf';

                            $_SESSION['user'] = new Customer($row['userId'], $fName, $lName, "", $email, $address, $phoneNum);


                        } else {
                            echo "error";
                        }

                    }
                }
            }
            #use invalid again to determine if account was successfully made
            if ($isValid) {
                #obtain userId, will be -1 for guest, or will be of the new account that was created, or will be currently logged in id
                $userId = $_SESSION['user']->getUserId();

                //insert into receipts (userID, date, contents) values  ("-1" , now(), 'asaasdfljasdlfjadslkjflkdsajfladsjflsdjlfadjsfasdf');
                if ($db->queryDB("INSERT INTO receipts (userId, date, contents) values ('" . $userId . "', now(), '".$_SESSION['receipt']."');")) {
                    header('Location:/online-marketplace/thankYou.php');
                } else {
                    #todo display error if something goes wrong
                }
            }//end isValid
        }
    }//end if onSubmit


        echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='POST'>
         First Name:&emsp;<input type='text' name='fName' value='" . $fName . "'><span style='color:red'>* " . $fNameErr . "</span><br><br>
         Last Name:&emsp;<input type='text' name='lName' value='" . $lName . "'><span style='color:red'>* " . $lNameErr . "</span><br><br>
         Email:&emsp;<input type='text' name='email' value='" . $email . "'><span style='color:red'>* " . $emailErr . "</span><br><br>
         Address:&emsp;<input type='text' name='address' value='" . $address . "'><span style='color:red'>* " . $addressErr . "</span><br><br>
         Phone Number:&emsp;<input type='text' name='phoneNumber' value='" . $phoneNum . "'><span style='color:red'>* " . $phoneNumErr . " </span><br><br>
          <div class='form-header'>
                <h4 class='title'>Credit Card Details</h4>
            </div>
            <div class='form-body'>
         
                <!-- Card Number -->
                <input type='text' name='creditCard' placeholder='Card Number'><span style='color:red'>* " . $creditCardErr . "</span><br><br>
         
                <!-- Date Field -->
                <div class='date-field'>
                  <div class='month'>
                    <select name='Month'>
                      <option value='january'>January</option>
                      <option value='february'>February</option>
                      <option value='march'>March</option>
                      <option value='april'>April</option>
                      <option value='may'>May</option>
                      <option value='june'>June</option>
                      <option value='july'>July</option>
                      <option value='august'>August</option>
                      <option value='september'>September</option>
                      <option value='october'>October</option>
                      <option value='november'>November</option>
                      <option value='december'>December</option>
                    </select>
                  </div>
                  <div class='year'>
                    <select name='Year'>
                      <option value='2016'>2016</option>
                      <option value='2017'>2017</option>
                      <option value='2018'>2018</option>
                      <option value='2019'>2019</option>
                      <option value='2020'>2020</option>
                      <option value='2021'>2021</option>
                      <option value='2022'>2022</option>
                      <option value='2023'>2023</option>
                      <option value='2024'>2024</option>
                    </select>
                  </div>
                </div>
         
                <!-- Card Verification Field -->
                <div class='card-verification'>
                    <div class='cvv-input'>
                        <input name='cvv' type='text' placeholder='CVV'><span style='color:red'>* " . $cvvErr . "</span><br><br>
                    </div>
                    <div class='cvv-details'>
                        <p>3 or 4 digits usually found on the signature strip</p>
                    </div>
                </div>
          <input type='hidden' name='launchParameter' value='onSubmit'>
          <input type='submit' name='submit' value='Submit'>";

        # if user is guest, then offer then a chance to create account through billing info
        if ($_SESSION['user']->getUserId() == -1) {
            echo "<input type='checkbox' name='createAccount' value='createAccount'> Create Account<br><br>
                    <input type='password' name='password' placeholder='Password'>(if creating account)<span style='color:red'>* ".$passwordErr."</span><br><br/>
                    <input type='password' name='confirmPassword' placeholder='Confirm Password'>(if creating account)<span style='color:red'>* ".$confirmPasswordErr."</span><br><br/>";
        }
         echo "</form> ";
}
#
outputFooter();