<!doctype html>
<html>
<head>
  <title>Success</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
  <?php
    $state = "C";//needs approval
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";//not applicable

    session_start();
    $destination = $_SESSION["destination"];
    $dateListed = $_SESSION["dateListed"];
    $weight = $_SESSION["weight"];
    $origin = $_SESSION["origin"];
    $rate=$_SESSION["rate"];
    $clientID=$_SESSION['clientID'];//for integration with login page
    $miles=$_SESSION['miles'];
    $ratePerMile=($rate/$miles);
    $listingID=$_SESSION['listingID'];

    //$clientName=$_SESSION['clientName']; for integration with login page
    //placeholder until login integration

    require_once("db.php");

    $sql = "update listing set origin='$origin', destination='$destination', dateListed='$dateListed',
    weight='$weight', rate='$rate', state='$state', CDL='$CDL',
    dateFufilled='$dateFufilled', clientID='$clientID', miles='$miles', ratePerMile='$ratePerMile'";



    /*"insert into listing
            (       origin,     destination,   dateListed,     weight,    rate,   state,    CDL,    dateFufilled,    clientID,    miles,    ratePerMile,    clientName)
            values ('$origin', '$destination', '$dateListed', '$weight', '$rate','$state', '$CDL', '$dateFufilled', '$clientID', '$miles', '$ratePerMile', '$clientName')";
            */
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from listing where destination='$destination' and
                dateListed='$dateListed' and
                weight='$weight' and
                origin='$origin' and
                rate='$rate' and state='$state' and
                CDL='$CDL' and
                dateFufilled='$dateFufilled'";
                $result=$mydb->query($sql2);
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

</body>
</html>
