<?php
require_once("layout.php");
require("DatabaseConnection.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Log In", $_SESSION['user']->getUserId());

$db = new DatabaseConnection();
$email = "";
if (isset($_POST["email"]) && isset($_POST["password"]) ) {
    $email = $_POST["email"];
    $pword = $_POST["password"];
    $result = $db->queryDB("SELECT * FROM users where email = '" . $email . "' and password = '" . $pword . "';");
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_array();
        unset($_SESSION['user']);
        $_SESSION['user'] = new Customer($row["userId"],$row["firstName"], $row["lastName"],$row["email"],$row["address"],$row["phone"]);
        header('Location:/online-marketplace/index.php');
    }
    else {
         header("Location:/online-marketplace/login.php?retry=".$email);
    }
}
# used to check if login was invalid, if so display prompt to retry
if(isset($_GET["retry"])){
    echo "Login information was not found.  Please try again.";
    $email = $_GET["retry"];
}


echo "<form action='#' method='POST'>
Email: <input type='text' name='email' value='".$email."'><br>
Password: <input type='password' name='password'><br>
<input type='submit'>
</form>
";

echo "<form action='newUser.php' method='POST'>
Don't have an account?  <input type='submit' value='Click Here'>  to create one.
</form>
";



outputFooter();