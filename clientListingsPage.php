<html>
<head>
  <title>Client Listings History</title>
</head>
<body>
<table>
  <tr>
    <td>Origin:</td>
    <td><?php
    $clientID=3;//placeholder
    require_once("db.php");
    $sql="select distinct origin from listing where clientID='$clientID'";
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
    $sql="select distinct destination from listing where clientID='$clientID'";
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
    <td></td>
  </tr>
</table>
<div id='contentArea'></div>
</body>
</html>

<?php
session_start();

$clientName=$_SESSION['clientName'];
$clientID=$_SESSION['clientID'];

$sql = "select * from listing where clientID='$clientID' and clientName='$clientName'";
$result = $mydb->query($sql);
echo
"<table>
    <tr>
      <th>  Client Name </th>
      <th>  Origin  </th>
      <th>  Destination </th>
      <th>  date listed </th>
      <th>  Weight  </th>
      <th>  rate  </th>
      <th>  Miles </th>
      <th>  Rate per Mile </th>
      <th>Detail View</th>
    </tr>";

  while($row = mysqli_fetch_array($result)) {
    echo
    "<tr>
        <td>".$row['clientName']."</td>
        <td>".$row['origin']."</td>
        <td>".$row['destination']."</td>
        <td>".$row['dateListed']."</td>
        <td>".$row['weight']."</td>
        <td>".$row['rate']."</td>
        <td>".$row['miles']."</td>
        <td>".$row['ratePerMile']."</td>
        <td><form type='submit' name='listingID'
        value='View More' method='post'
        action='$_SERVER['PHP_SELF']'/>
        <input type="hidden" name="clientID" value=".$row['clientID']." />
        </form></td>
      </tr>";
  }
  echo "</table>"
  if (isset($_POST["submit"])) {
    $_SESSION['clientID'];
    if(isset($_POST["clientID"])) $clientID=$_POST["clientID"];
    Header("Location:clientListingDetailView.php");
  }
?>