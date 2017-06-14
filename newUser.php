<!DOCTYPE HTML>
<html>
<body>


<form action="#" method="get">
<input type="text" name="name" placeholder="Your Name"></input><br/>
<input type="text" name="email" placeholder="Your Email"></input><br/>
<input type="text" name="contact" placeholder="Your Mobile"></input><br/>
<input type="submit" name="submit" value="Submit"></input>
</form>

<?php
if( $_GET["name"] || $_GET["email"] || $_GET["contact"])
{
echo "Welcome: ". $_GET['name']. "<br />";
echo "Your Email is: ". $_GET["email"]. "<br />";
echo "Your Mobile No. is: ". $_GET["contact"];
}
?>

</body>
</html>
