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
  <li class="active"><a href="truckerLanding.php">Home</a></li>
  <li><a href="truckListingsPage.php">Listings</a></li>
  <li><a href="myLoads.php">My Loads</a></li>
  <li><a href="pastTruckerLoads.php">Past Loads</a></li>
    <li><a href="TruckerAreYouSure.php">Delete Account</a></li>
</ul>
<img src="macktruck.png" height=70% width=100% />
</ul>
  <?php
    //resume the session variable on this page
    session_start();
    $timeString = "";
    $currentTime = date("a");
    if ($currentTime == "am") {
      $timeString = "morning";
    } else {
      $timeString = "afternoon";
    }

    echo "<p>Good ".$timeString." ".$_SESSION["firstName"]."!</p>";

   ?>
   <p><a style ="background-color: white;"href="logout.php">Click here to log out</a></p>
</body>
</html>
