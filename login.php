<!DOCTYPE HTML>
<html>
<body>


<?php
# used to check if login was invalid, if so display prompt to retry
if(isset($_GET["retry"]) && $retry=$_GET["retry"]){
    echo "Login information was not found.  Please try again.";
}

?>

<form action="verifylogin.php" method="POST">
Email: <input type="text" name="email"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>


</body>
</html>

