<?php
require_once("layout.php");
require_once("Customer.php");
require("mailer.php")

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Contact Us", $_SESSION['user']->getUserId());

?>
<h3> Send us message we would love to here from you </h3>
<form id="ajax-contact" method="post">
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

    <div id='content'>
      <b>Phone</b>: (555) 555-555 <br>
      <b>Fax:</b> (555) 555-555 <br>
      <b>Email:</b> website@website.com <br>
      <b>Address:</b> 3042 Lost Way, Grand City, CA 91234
      <br>
      <br>

<?php
outputFooter();
