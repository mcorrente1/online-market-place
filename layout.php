<?php




$header = <<<HTML
<!doctype HTML public>
<html>
<head>
	<title>DropShop - Shop til you drop!</title>
	<link rel='stylesheet' type='text/css' href='./style.css' />
</head>

<body>
	<div id='container'>
		<div id='header'>
			<h2 style='text-align:center;'>Welcome to DropShop!</h2>
				<p style='text-align:center;'><a href='./index.php?view_cart=1'>View Cart</a></p>
		</div>
		<html>
		<body>

		<style>
		.nav_button {

		    border-radius: 8px;
		    background-color: #4CAF50;
		    border: none;
		    color: white;
		    padding: 15px 32px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 16px;
		    margin: 4px 2px;
		    -webkit-transition-duration: 0.4s; /* Safari */
		    transition-duration: 0.4s;

		    cursor: pointer;
		}

		.nav_buttonA {
		    background-color: white;
		    color: black;
		    border: 2px solid #4CAF50;
		}

		.nav_buttonA:hover {
		    background-color: #4CAF50;
		    color: white;
		}




		</style>
		</head>


		<a href= "Home.php" class="nav_button nav_buttonA">Home</a>
		<a href="About.php" class="nav_button nav_buttonA">About</a>
		<a href="Contact.php" class="nav_button nav_buttonA">Contact Us</a>
		<a href= "index.php" class="nav_button nav_buttonA">Store</a>
		<br>
		<br>
		<br>


		<div id='content'>
HTML;

$footer = <<<HTML
		</div><!-- End content-->
	</div><!-- End container-->
</body>
</html>
HTML;

?>
