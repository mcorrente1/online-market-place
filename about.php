<?php
require_once("layout.php");
require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}
outputHeader("About", $_SESSION['user']->getUserId());

?>
    <div id='content'>
      Rogue Soda was founded in 2020 and with our mantra "We Don't Follow the Rules", in order to create the best. <br>
      We are 110% commited with providing our customers with quality and we want to maske sure that <br>
      you have the best expericene. Your satisfication is our goal and we strive to earn your business. <br>
    </div>

<?php
outputFooter();