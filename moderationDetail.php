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
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="adminLanding.php">Home</a> |
 <a href="moderationNew.php">Moderation</a>
</nav>
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
      echo "<table>
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
  echo
  "<tr>
    <td><form method='post'
        action='".$_SERVER['PHP_SELF']."'>
          <input type='submit' name='approve' value='Approve Listing' />
        </form>
    </td>
    <td><form method='post'
        action='".$_SERVER['PHP_SELF']."'>
          <input type='submit' name='submit' value='Cancel Listing' />
        </form>
    </td>
  </tr>";
echo "</table>";
    }

   ?>
</body>
</html>
