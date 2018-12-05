<?php
require_once("db.php");
session_start();
//$clientName=$_SESSION['clientName'];
//$clientID=$_SESSION['clientID'];
if (isset($_POST["submit"])) {
  require_once("db.php");

  $sql = "delete from admin where adminID=$adminID";
    Header("Location:  logout.php");
  }
?>
<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
      <img src="reynholm.jpg" height=5% width=5% />
  <ul class="nav nav-tabs">
  <li class="active"><a href="adminLanding.php">Home</a></li>
  <li><a href="adminViewListings.php">View Listings</a></li>
  <li><a href="moderationNew.php">Moderation</a></li>
  <li><a href="adminViewCurrentListings.php">View Current Listings</a></li>
    <li><a href="adminAreYouSure.php">Delete your Account</a></li>
</ul>
  <?php
  echo"
<p>If you click the button below your account WILL BE DELETED. Are you sure you wanna do it, man? Don't do it if you're not ABSOLUTELY sure. Okay?</p>
  <form method='post'
      action='".$_SERVER['PHP_SELF']."'>
        <input type='submit' name='submit' value='Delet This' />
      </form>"?>

</body>
</html>
