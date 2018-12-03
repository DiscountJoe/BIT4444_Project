<?php
require_once("db.php");
session_start();
//$clientName=$_SESSION['clientName'];
//$clientID=$_SESSION['clientID'];
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  moderationDetail.php");
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
      <li><a href="adminLanding.php">Home</a></li>
      <li class="active"><a href="aminViewListings.php">View Listings</a></li>
      <li><a href="moderationNew.php">Moderation</a></li>
        <li><a href="adminViewCurrentListings.php">View Current Listings</a></li>

    </ul>
<br>
</html>

<?php

//session_start();

//$clientName=$_SESSION['clientName'];
//$clientID=$_SESSION['clientID'];

$sql = "select * from listing where state = 'NA'";
$result = $mydb->query($sql);
echo
"<div><table>
    <tr>
      <th>  Client Name </th>
      <th>  Origin  </th>
      <th>  Destination </th>
      <th>  date listed </th>
      <th>  Weight  </th>
      <th>  rate  </th>
      <th>  Miles </th>
      <th>  Rate per Mile </th>
      <th>Drop?</th>
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
        <td>".$row['ratePerMile']."</td>";
        echo"<td><form method='post'
            action='".$_SERVER['PHP_SELF']."'>
            <input type='hidden' name='listingID' value=".$row['listingID']." />
            <input type='submit' name='submit' value='View Detail' />
            </form></td></tr>";
  }
  echo "</table></div>"


?>
