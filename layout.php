<?php


$header = <<<HTML
<!doctype HTML public>
<html>
<head>

<link rel='stylesheet' type='text/css' href='./website.css'/>
<title>Rogue Soda - Store</title>
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
			<p style='text-align:right;'><a href='./index.php?view_cart=1'>View Cart</a></p>

HTML;

$footer = <<<HTML
		</div><!-- End content-->
	</div><!-- End container-->
</body>
</html>
HTML;

?>
