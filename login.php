<!DOCTYPE HTML>
<html>
<body>

<?php

require("DatabaseConnection.php");

$db = new DatabaseConnection();
$email = "";

if (isset($_POST["email"]) && isset($_POST["password"]) ) {
    $email = $_POST["email"];
    $pword = $_POST["password"];
    $result = $db->queryDB("SELECT * FROM users where email = '" . $email . "' and password = '" . $pword . "';");
    if ($result && $result->num_rows == 1) {
        header('Location:/online-marketplace/successful.php');
    }
    else {
        header('Location:/online-marketplace/login.php/?retry=false');
    }
}

# used to check if login was invalid, if so display prompt to retry
if(isset($_GET["retry"])){
    echo "Login information was not found.  Please try again.";
}

?>

<form action="#" method="POST">
Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>



</body>
</html>

