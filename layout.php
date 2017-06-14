<?php


$header = <<<HTML
<!doctype HTML public>
<html>
<head>
	<title>Rogue Soda</title>
	<link rel='stylesheet' type='text/css' href='./website.css' />
	<link rel="icon" href="http://i.imgur.com/QHzBsXy.png">
</head>


<body>
	<div id='container'>
		<div id='header'>
			<h2 style='text-align:center;'>Rogue Soda's Flavors</h2>


						<a href= "home.php" class="nav_button nav_buttonA">Home</a>
						<a href="about.php" class="nav_button nav_buttonA">About</a>
						<a href="contact.php" class="nav_button nav_buttonA">Contact Us</a>
						<a href= "index.php" class="nav_button nav_buttonA">Store</a>

						<img align='right' src='http://i.imgur.com/QHzBsXy.png' alt = 'Rogue Soda Logo' width=25% height=35%>

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
