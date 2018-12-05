<?php
require_once("db.php");
session_start();
//$clientName=$_SESSION['clientName'];
//$clientID=$_SESSION['clientID'];
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  cancelListing.php");
  }
  if (isset($_POST["approve"])) {
      if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
      Header("Location:  approve.php");
    }
?>
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
  <?php
    //resume the session variable on this page
  //  session_start();
    if (isset($_SESSION['listingID'])) $listingID=$_SESSION['listingID'];

    echo $listingID;
    require_once("db.php");
    $sql="select distinct * from listing where listingID='$listingID'";
    $result = $mydb->query($sql);
    while($row=mysqli_fetch_array($result)){
      $Selection=$row["origin"];
      echo "<div><table>
      <tr>
      <th>Listing Information</th>
      <th></th>
      </tr>
      <tr>
        <td>Status</td>";
        if ($row['state']=="NA"){echo "<td>Needs Approval</td>";}
        elseif($row['state']=="L"){echo "<td>Listed</td>";}
        elseif($row['state']=="IT"){echo "<td>In Transit</td>";}
        elseif($row['state']=="F"){echo "<td>Fulfilled</td>";}
        elseif($row['state']=="R"){echo "<td>Removed</td>";}

      echo "</tr>
  <tr>
    <td>client ID</td>
    <td>".$row['clientID']."</td>
  </tr>
  <tr>
    <td>Client Name</td>
    <td>".$row['clientName']."</td>
  </tr>
  <tr>
    <td>Starting Location</td>
    <td>".$row['origin']."</td>
  </tr>
  <tr>
    <td>Destination</td>
    <td>".$row['destination']."</td>
  </tr>
  <tr>
    <td>Total Miles</td>
    <td>".$row['miles']."</td>
  </tr>
  <tr>
    <td>Date Listed</td>
    <td>".$row['dateListed']."</td>
  </tr>
  <tr>
    <td>Date Fulfilled</td>
    <td>".$row['dateFufilled']."</td>
  </tr>
  <tr>
    <td>Rate/Mile ($)</td>
    <td>".$row['ratePerMile']."</td>
  </tr>
  <tr>
    <td>Package Weight(tons)</td>
    <td>".$row['weight']."</td>
  </tr>
  <tr>
    <td>Driver CDL</td>
    <td>".$row['CDL']."</td>
  </tr>";
  if($row['state']!=="f"||$row['state']!=="IT")
  
echo "</table></div>";
    }

   ?>
</body>
</html>
