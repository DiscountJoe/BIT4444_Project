<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="truckerLanding.php">Home</a>
      <a href="displayListings.php">All Loads</a>
      <a href="myLoads.php">My Current Loads</a>
      <a href="pastLoads.php">My Past Loads</a>
</nav>
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
   <p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
