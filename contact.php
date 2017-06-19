<!DOCTYPE html>
<html>
<body>

  <head>

  <link rel='stylesheet' type='text/css' href='./website.css'/>
  <title>Rogue Soda - Contact Us</title>
  <link rel="icon" href="http://i.imgur.com/9EVFXmq.png">
  </head>


<body>
	<div id='container'>
		<div id='header'>
      <a align='right' href="newUser.php">Sign Up</a> <a> | </a> <a href="login.php">Login</a>
      <h2 align='center'>Contact Us</h2>
      <img align='right' src='http://i.imgur.com/9EVFXmq.png' alt = 'Rogue Soda Logo' width=25% height=1%>



				<a href= "home.php" class="nav_button nav_buttonA">Home</a>
				<a href="about.php" class="nav_button nav_buttonA">About</a>
				<a href="contact.php" class="nav_button nav_buttonA">Contact Us</a>
				<a href= "index.php" class="nav_button nav_buttonA">Store</a>

		</div>
		<div id='content'>
      Phone: (555) 555-555 <br>
      Fax: (555) 555-555 <br>
      Email: website@website.com <br>
      <br>
      <br>

      <h3> Send us message we would love to here from you </h3>
      <form id="ajax-contact" method="post" action="mailer.php">
    <div class="field">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="field">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="field">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
    </div>

    <div class="field">
        <button type="submit">Send</button>
    </div>

  </div>
</form>
</body>








</html>
