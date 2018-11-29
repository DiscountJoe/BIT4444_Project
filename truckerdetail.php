<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="landing.php">Home</a> |
 <a href="timetable.php">Moderation</a> |
 <a href="record.php">Your Record</a> |
 <a href="advising.php">Advising</a> |
</nav>
  <?php
    //resume the session variable on this page
    session_start();
    if (isset($_SESSION['listingID'])) $listingID=$_SESSION['listingID'];
    echo $listingID;
   ?>
</body>
</html>
