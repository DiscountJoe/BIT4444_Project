<?php
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  truckerdetail.php");
  }
?>
<html>
<head>
  <title>Trucker Listings History</title>
</head>
<body>
<table>
  <tr>
    <td>Origin:</td>
    <td><?php
    $truckerID=3;//placeholder
    require_once("db.php");
    $sql="select distinct origin from listing where truckerID='$truckerID'";
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
    $sql="select distinct destination from listing where truckerID='$truckerID'";
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
$clientName=$_SESSION['CDL'];
$clientID=$_SESSION['truckerID'];
$sql = "select * from listing where truckerID='$truckerID' and CDL='$CDL'";
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
        <input type='submit' name='submit' value='submit' />
        </form></td>
      </tr>";
  }
  echo "</table>";
?>