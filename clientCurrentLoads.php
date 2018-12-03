<?php
session_start();
if(isset($_SESSION['clientName'])) {$clientName=$_SESSION['clientName'];
}else{Header("Location:  clientLogin.php");}
if(isset($_SESSION['clientID'])) {$clientID=$_SESSION['clientID'];
}else{Header("Location:  clientLogin.php");}

if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  clientListingDetailView.php");
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
  <li class="active"><a href="clientLanding.php">Home</a></li>
  <li><a href="clientListingsPage.php">Your Listings</a></li>
  <li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  <li><a href="clientPastLoads.php">Past Loads</a></li>
  <li><a href="createListing.php">Create Listing</a></li>
</ul>
<br>
<div><table>
  <tr>
    <td>Origin:</td>
    <td><?php
    require_once("db.php");
    $sql="select distinct origin from listing where clientID='$clientID' and (state='NA' or state='IT' or state='L')";
    $result = $mydb->query($sql);
    echo "<select id='originDropdown'>";
    while($row=mysqli_fetch_array($result)){
      $Selection=$row["origin"];
      echo "<option value = '$Selection'>$Selection</option>";
    }
    echo "</select>";
    ?></td>
    <td>Maximum Rate/Mile:</td>
    <td><input type="number" name="maxRPM" value="" /></td>
    <td>Maximum Weight:</td>
    <td><input type="number" name="maxWeight" value="" /></td>
  </tr>
  <tr>
    <td>Destination:</td>
    <td><?php
    require_once("db.php");
    $sql="select distinct destination from listing where clientID='$clientID' and (state='NA' or state='IT' or state='L')";
    $result = $mydb->query($sql);
    echo "<select id='destinationDropdown'>";
    while($row=mysqli_fetch_array($result)){
      $Selection=$row["destination"];
      echo "<option value = '$Selection'>$Selection</option>";
    }
    echo "</select>";
    ?></td>
    <td>Minimum Rate/Mile:</td>
    <td><input type="number" name="minRPM" value="" /></td>
    <td>Minimum Weight:</td>
    <td><input type="number" name="minWeight" value="" /></td>
  </tr>
  <tr>
    <td>Date Listed:</td>
    <td><input type="date" name="dateListed" value="" /></td>
    <td><input type="hidden" name="state" value="" /></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table></div>
<br>


<?php
$sql = "select * from listing where clientID='$clientID' and (state='NA' or state='IT' or state='L')";
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
        elseif($row['state']=="C"){echo "<td>Canceled</td>";}

    echo"<td><form method='post'
        action='".$_SERVER['PHP_SELF']."'>
        <input type='hidden' name='listingID' value=".$row['listingID']." />
        <input type='submit' name='submit' value='View More' />
        </form></td>
      </tr>

      ";
  }
  echo "</table></div>";

?>
<p><a href="logout.php">Click here to log out</a></p>

</body>
</html>
