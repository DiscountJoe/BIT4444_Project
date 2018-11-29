<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="clientLanding.php">Home</a>
      <a href="clientListingsPage.php">All Loads</a>
      <a href="clientCurrentLoads.php">My Current Loads</a>
      <a href="clientPastLoads.php">My Past Loads</a>
</nav>
  <?php
    //resume the session variable on this page
    session_start();
    $clientID = $_SESSION["clientID"];
    $clientName = $_SESSION["clientName"];
    $timeString = "";
    $currentTime = date("a");
    if ($currentTime == "am") {
      $timeString = "morning";
    } else {
      $timeString = "afternoon";
    }

    echo "<p>Good ".$timeString." ".$clientName."!</p>";

   ?>
   <p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
