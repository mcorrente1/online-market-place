<?php
require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Contact Us", $_SESSION['user']->getUserId());

?>
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

<?php
outputFooter();
