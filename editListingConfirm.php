<?php
  session_start();
?>
<html>
<head>
  <title>Success</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
</head>
<body>
  <img src="reynholm.jpg" height=5% width=5% />
<ul class="nav nav-tabs">
<li><a href="clientLanding.php">Home</a></li>
<li><a href="clientListingsPage.php">Your Listings</a></li>
<li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
<li><a href="clientPastLoads.php">Past Loads</a></li>
<li><a href="createListing.php">Create Listing</a></li>
<li><a href="clientAccountManagement.php">Manage Account</a></li>
<li><a href="">Listing Cancelled</a></li>
</ul>
<div style='margin-left: auto; display: block; margin-right: auto;width: 650px;'>
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

           echo "<table style='background-color:white;'>
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
</div>
<p><a href="clientListingsPage.php">Click Here to Return to the Listings Page</a></p>
<p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
