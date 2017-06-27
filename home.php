<?php
    require_once("layout.php");
    require_once("Customer.php");

if(!isset($_SESSION)) {
    session_start();
}

outputHeader("Home", $_SESSION['user']->getUserId());

?>

<html>
<title>Featured Products</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<h2 class="w3-center">Featured Products</h2>

<div class="w3-content w3-display-container">
  <img class="mySlides" src="http://i.imgur.com/gyIdAbM.png" style="width:100%">
  <img class="mySlides" src="http://i.imgur.com/vnm9xfk.png" style="width:100%">
  <img class="mySlides" src="http://i.imgur.com/VKqUt94.png" style="width:100%">

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
</script>

</body>
</html>

<?php
outputFooter(); ?>
