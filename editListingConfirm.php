<?php
  session_start();
?>
<html>
<head>
  <title>Success</title>
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


    $destination = $_SESSION["destination"];
    $dateListed = $_SESSION["dateListed"];
    $weight = $_SESSION["weight"];
    $origin = $_SESSION["origin"];
    $rate=$_SESSION["rate"];
    $clientID=$_SESSION['clientID'];
    $miles=$_SESSION['miles'];
    $ratePerMile=($rate/$miles);
    $listingID=$_SESSION['listingID'];
    $state = "NA";//needs approval
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";


    $clientName=$_SESSION['clientName'];

    require_once("db.php");

    $sql = "update listing set origin='$origin', destination='$destination', dateListed='$dateListed',
    weight='$weight', rate='$rate', state='$state', CDL='$CDL',
    dateFufilled='$dateFufilled', miles='$miles', ratePerMile='$ratePerMile'where listingID='$listingID'";

         $result=$mydb->query($sql);

         if ($result==1) {


           $sql = "select * from listing where listingID='$listingID'";
                $result=$mydb->query($sql);
                while($row = mysqli_fetch_array($result)){
           echo "<p>An edited Listing is now pending re-approval:</p></br>";

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
<a href="clientListingsPage.php">Click Here to Return to the Listings Page</a>

</body>
</html>
