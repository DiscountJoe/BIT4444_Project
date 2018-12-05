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
<body>
  <?php
    $state = "C";//cancelled
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";//not applicable

    session_start();
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
      echo "<a href='moderationNew.php'>Back to Moderation</a>";
    }

    //$clientName=$_SESSION['clientName']; for integration with login page
    $clientName="Pedros inconspicuous shipping crates"; //placeholder until login integration

    require_once("db.php");

    $sql = "update listing set state = '$state' where listingID=$listingID";

    /*"insert into listing
            (       origin,     destination,   dateListed,     weight,    rate,   state,    CDL,    dateFufilled,    clientID,    miles,    ratePerMile,    clientName)
            values ('$origin', '$destination', '$dateListed', '$weight', '$rate','$state', '$CDL', '$dateFufilled', '$clientID', '$miles', '$ratePerMile', '$clientName')";
            */
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from listing where listingID=$listingID";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>An edited Listing is now cancelled. And that's tea, sis!:</p></br>";

           echo "<table>
              <tr>
                <th>  Client Name </th>
                <th>  Origin  </th>
                <th>  Destination </th>
                <th>  date listed </th>
                <th>  Weight  </th>
                <th>  rate  </th>
                <th>  Miles </th>
                <th>  Rate per Mile </th>
              </tr>
              <tr>
                <td>".$row['clientName']."</td>
                <td>".$row['origin']."</td>
                <td>".$row['destination']."</td>
                <td>".$row['dateListed']."</td>
                <td>".$row['weight']."</td>
                <td>".$row['rate']."</td>
                <td>".$row['miles']."</td>
                <td>".$row['ratePerMile']."</td>
              </tr>
            </table>";
                   }
         }
         else
         {
           echo "an error occured, please try again and ensure that the data is valid.";
         }
  ?>

</body>
</html>
