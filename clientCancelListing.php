<!doctype html>
<html>
<head>
  <title>Success</title>
</head>
   <link rel="stylesheet" href="stylesheet.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body style="background-color:slategrey;">
  <img src="reynholm.jpg" height=5% width=5% />
<ul class="nav nav-tabs">
<li><a href="clientLanding.php">Home</a></li>
<li><a href="clientListingsPage.php">Your Listings</a></li>
<li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
<li><a href="clientPastLoads.php">Past Loads</a></li>
<li><a href="createListing.php">Create Listing</a></li>
<li><a href="clientAccountManagement.php">Manage Account</a></li>
<li class="active"><a href="">Cancel Listing</a></li>
</ul>
<div style='margin-left: auto; display: block; margin-right: auto;width: 650px;'>
  <?php
    $state = "C";//cancelled
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";//not applicable

    session_start();
    $listingID=$_SESSION['listingID'];

    $clientName=$_SESSION['clientName'];

    require_once("db.php");

    $sql = "update listing set state = '$state' where listingID=$listingID";

         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from listing where listingID=$listingID";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>An edited Listing is now cancelled</p></br>";

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
</div>
<p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
