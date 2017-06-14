<!DOCTYPE HTML>
<html>
<body>

<form action="sucessful.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>

</body>
</html>

<?php
if( $_GET["username"] || $_GET["password"])
{
  echo "Welcome: ". $_GET['name']. "<br />";
  echo "login in successful.";
}
?>
