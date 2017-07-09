<?php
require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}
outputHeader("About", $_SESSION['user']->getUserId());

?>
<div id='content'>
  Rogue Soda was founded in 2020 and with our mantra <br>
  "We Don't Follow the Rules", in order to create the best. <br>
  We are 110% commited with providing our customers with <br>
  quality and we want to maske sure that you have the best<br>
   expericene. Your satisfication is our goal and we strive <br>
   to earn your business. <br>
</div>

<img align='left' src='http://i.imgur.com/SDh3G2j.jpg' alt = 'Satisfaction Guarantee' width=25% height=35%>
  <br>
<img align='right' src='http://i.imgur.com/w105fVY.jpg' alt = 'Satisfaction Guarantee' width=60% height=40%>

<?php
outputFooter();
