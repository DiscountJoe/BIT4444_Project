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
  <img src="reynholm.jpg" height="5%" width="5%">
  <?php
    echo "<div>Goodbye! ";
    echo "You have successfully logged out. Please <a href='who.html'>click here to login again</a></div>";

    session_start();
    if (isset($_SESSION['clientID'])) $_SESSION['clientID']="";
      if (isset($_SESSION['adminID'])) $_SESSION['adminID']="";
            if (isset($_SESSION['CDL'])) $_SESSION['CDL']="";
  ?>

</body>
</html>
