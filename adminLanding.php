<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="adminlanding.php">Home</a> |
 <a href="moderation.php">Moderation</a> |

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

    echo "<p>Good ".$timeString."!</p>";

   ?>
   <p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
