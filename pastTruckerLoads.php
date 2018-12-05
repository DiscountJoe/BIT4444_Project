<?php
session_start();
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  truckerDetail.php");
  }
?>
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
  <li class="active"><a href="truckerLanding.php">Home</a></li>
  <li><a href="truckerListingsPage.php">Listings</a></li>
  <li><a href="myTruckerLoads.php">My Loads</a></li>
  <li><a href="pastTruckerLoads.php">Past Loads</a></li>
</ul>
</body>
</html>

<?php
require_once("db.php");

$CDL=$_SESSION['CDL'];
//$clientID=$_SESSION['truckerID'];
$sql = "select * from listing where CDL='$CDL' and state='F'";
$result = $mydb->query($sql);
echo
"<div><table>
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
        <input type='hidden' name='listingID' value=".$lid." />
        <input type='submit' name='submit' value='View Detail' />
        </form></td>
      </tr>";
  }
  echo "</table></div>";
?>
