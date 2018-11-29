<?php
session_start();
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  moderationDetail.php");
  }
?>
<html>
<head>
  <title>Current Listings</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="adminLanding.php">Home</a> |
 <a href="moderationNew.php">Moderation</a> |
 <a href="adminViewListings.php">View All Listings</a> |
 <a href="adminViewCurrentListings.php">View All CURRENT Listings</a>

</nav>
</body>
</html>

<?php
require_once("db.php");

//$CDL=$_SESSION['CDL'];
//$clientID=$_SESSION['truckerID'];
$sql = "select * from listing where state='L'";
$result = $mydb->query($sql);
echo
"<table>
    <tr>
    <th>  ListingID </th>
    <th>  Client Name </th>
    <th>  Origin  </th>
    <th>  Destination </th>
    <th>  date listed </th>
    <th>  Weight  </th>
    <th>  rate  </th>
    <th>  Miles </th>
    <th>  Rate per Mile </th>
    <th>  Status </th>
    <th>Detail View</th>

    </tr>";
  while($row = mysqli_fetch_array($result)) {
    $lid=$row['listingID'];
    echo
    "<tr>
    <td>".$row['listingID']."</td>
    <td>".$row['clientName']."</td>
    <td>".$row['origin']."</td>
    <td>".$row['destination']."</td>
    <td>".$row['dateListed']."</td>
    <td>".$row['weight']."</td>
    <td>$".$row['rate']."</td>
    <td>$".$row['miles']."</td>
    <td>$".$row['ratePerMile']."</td>";

    if ($row['state']=="NA"){echo "<td>Needs Approval</td>";}
elseif($row['state']=="L"){echo "<td>Listed</td>";}
elseif($row['state']=="IT"){echo "<td>In Transit</td>";}
elseif($row['state']=="F"){echo "<td>Fulfilled</td>";}
elseif($row['state']=="R"){echo "<td>Removed</td>";}
      echo"<td><form method='post'
        action='".$_SERVER['PHP_SELF']."'>
        <input type='text' name='listingID' value=".$lid." />
        <input type='submit' name='submit' value='View Detail' />
        </form></td>
      </tr>";
  }
  echo "</table>";
?>
