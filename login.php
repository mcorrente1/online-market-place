<!DOCTYPE HTML>
<html>
<body>

<?php

require("DatabaseConnection.php");

$db = new DatabaseConnection();

# used to check if login was invalid, if so display prompt to retry
if(isset($_GET["retry"]) && $retry=$_GET["retry"]){
    echo "Login information was not found.  Please try again.";
}

if (isset($_POST["email"]) && isset($_POST["password"]) ) {
    $email = $_POST["email"];
    $pword = $_POST["password"];
    $result = $db->queryDB("SELECT * FROM users where email = '" . $email . "' and password = '" . $pword . "';");
    if ($result && $result->num_rows == 1) {
        header('Location:/online-marketplace/successful.php');
    }
    else {
        #todo make sure that user is notified that login failed
        header('Location:/online-marketplace/login.php/?retry=false');
    }
}

?>

<form action="#" method="POST">
Email: <input type="text" name="email"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>



</body>
</html>

