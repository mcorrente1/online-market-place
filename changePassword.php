<?php
require_once("layout.php");
require_once("Customer.php");
require("DatabaseConnection.php");


if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Change Password", $_SESSION['user']->getUserId());

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET["success"])) {
    echo "Password successfully changed.<br/><br/>";
}

// define variables and set to empty values
$currentPasswordErr = $passwordErr = $confirmPasswordErr = "";
$currentPassword = $password = $confirmPassword = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    if (empty($_POST["currentPassword"])) {
        $currentPasswordErr = "Enter your current password";
        $isValid = false;
    } else {
        $currentPassword = test_input($_POST["currentPassword"]);
    }
    #todo check that current password is correct

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

    if($isValid){

        $db = new DatabaseConnection();

        # check if current password is correct
        $result = $db->queryDB("SELECT * from users WHERE email = '".$_SESSION['user']->getEmail()."' and password = '".$currentPassword."';");

        if ($result && $result->num_rows == 1) {
            if ($db->queryDB("UPDATE users SET password = '". $password ."' WHERE userId = '".$_SESSION['user']->getUserId()."';")){
                header('Location:/online-marketplace/changePassword.php?success=TRUE');
            }
            else {
                #todo display error if something goes wrong
                print "error";
            }
        }
        else{
            $currentPasswordErr = "Current password does not match logged in account. Please try again.";
        }
    }//end isValid
}

?>

<span style="color:red">* required field.</span><br><br/>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <input type="password" name="currentPassword" placeholder="Current Password"><span style="color:red">* <?php echo $currentPasswordErr;?></span><br><br/>
    <input type="password" name="password" placeholder="New Password"><span style="color:red">* <?php echo $passwordErr;?></span><br><br/>
    <input type="password" name="confirmPassword" placeholder="Confirm Password"><span style="color:red">* <?php echo $confirmPasswordErr;?></span><br><br/>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>

<?php
outputFooter();