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
<br>

<form method="post" onclick ="<?php ?>" >
</html>

<?php
require_once("db.php");
session_start();

//$clientName=$_SESSION['clientName'];
//$clientID=$_SESSION['clientID'];

$sql = "select * from listing where state = 'NA'";
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
        <td>".$row['ratePerMile']."</td>

      </tr>";
  }
  echo "</table>"


?>
