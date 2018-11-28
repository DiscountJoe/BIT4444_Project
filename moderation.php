<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="landing.php">Home</a> |
 <a href="moderation.php">Moderation</a>
</nav>
<br>

<?php
  require_once("db.php");

 //send a query to the database
 $sql = "select *
          from needapproval
          ";

 $results = $mydb->query($sql);
 //$result should be a resultset
 echo '<table style= "background-color:skyblue"><tr style= "background-color:steelblue; color:white;">'.'<th>Mod ID</th>'.'<th>clientID</th>'.'<th>ClientName</th>'.'<th>origin</th>'.'<th>destination</th>'.'<th>miles</th>'.'<th>rate</th>'.'<th>ratepermile</th>'.'<th>weight</th>'.'<th>dateListed</th></tr>';

 while($row = mysqli_fetch_array($results)) {
 echo '<tr>
          <td style= "background-color:darkorange; color:white;>'.$row["modID"].'</td>
          <td>'.$row["clientID"].'</td>
          <td>'.$row["clientName"].'</td>
          <td>'.$row["origin"].'</td>
          <td>'.$row["destination"].'</td>
          <td>'.$row["miles"].'</td>
          <td>'.$row["rate"].'</td>
          <td>'.$row["ratePerMile"].'</td>
          <td>'.$row["weight"].'</td>
          <td>'.$row["dateListed"].'</td>
      </tr>';
 }
 echo '</table>';

?>
