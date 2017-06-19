<!DOCTYPE HTML>
<html>
<body>
<<<<<<< HEAD
<head>

  <link rel='stylesheet' type='text/css' href='./website.css'/>
  <title>Rogue Soda - Home</title>
  <link rel="icon" href="http://i.imgur.com/9EVFXmq.png">
</head>

<body>
	<div id='container'>
		<div id='header'>
						<a align='right' href="newUser.php">Sign Up</a> <a> | </a> <a href="login.php">Login</a>
						<h2 align='center'>Store</h2>


						<a href= "home.php" class="nav_button nav_buttonA">Home</a>
						<a href="about.php" class="nav_button nav_buttonA">About</a>
						<a href="contact.php" class="nav_button nav_buttonA">Contact Us</a>
						<a href= "index.php" class="nav_button nav_buttonA">Store</a>

						<img align='right' src='http://i.imgur.com/9EVFXmq.png' alt = 'Rogue Soda Logo' width=25% height=35%>

		</div>
<div id='content'>
</form>
</div>

</body>
</html>

<?php
require("DatabaseConnection.php");
$db = new DatabaseConnection();
$email = "";
=======

<?php

require("DatabaseConnection.php");

$db = new DatabaseConnection();
$email = "";

>>>>>>> master
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
<<<<<<< HEAD
=======

>>>>>>> master
# used to check if login was invalid, if so display prompt to retry
if(isset($_GET["retry"])){
    echo "Login information was not found.  Please try again.";
}
<<<<<<< HEAD
=======

>>>>>>> master
?>

<form action="#" method="POST">
Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>
<<<<<<< HEAD
=======



</body>
</html>

>>>>>>> master
