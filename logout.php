<!doctype html>
<html>
<head>
  <title>Log out page</title>
</head>
<body>
  <img src="reynholm.jpg" height="5%" width="5%">
  <?php
    echo "<p>Goodbye!</p>";
    echo "You have successfully logged out. Please <a href='who.html'>click here to login again</a>";

    session_start();
    if (isset($_SESSION['clientID'])) $_SESSION['clientID']="";
      if (isset($_SESSION['adminID'])) $_SESSION['adminID']="";
            if (isset($_SESSION['CDL'])) $_SESSION['CDL']="";
  ?>

</body>
</html>
