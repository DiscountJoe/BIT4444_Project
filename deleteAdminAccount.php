<!doctype html>
<html>
<head>
  <title>Success</title>
</head>
<body>
  <?php


    session_start();
    $adminID = $_SESSION['adminID'];
  /*  $destination = $_SESSION["destination"];
    $dateListed = $_SESSION["dateListed"];
    $weight = $_SESSION["weight"];
    $origin = $_SESSION["origin"];
    $rate=$_SESSION["rate"];
    $clientID=$_SESSION['clientID'];//for integration with login page
    $miles=$_SESSION['miles'];
    $ratePerMile=($rate/$miles); */
    $listingID=$_SESSION['listingID'];
    if (isset($_SESSION['adminID']))
    {
      echo "<a href='logout.php'>Return</a>";
    }
    require_once("db.php");

    $sql = "delete from admin where adminID=$adminID";

    /*"insert into listing
            (       origin,     destination,   dateListed,     weight,    rate,   state,    CDL,    dateFufilled,    clientID,    miles,    ratePerMile,    clientName)
            values ('$origin', '$destination', '$dateListed', '$weight', '$rate','$state', '$CDL', '$dateFufilled', '$clientID', '$miles', '$ratePerMile', '$clientName')";
            */
         $result=$mydb->query($sql);

  ?>

</body>
</html>
