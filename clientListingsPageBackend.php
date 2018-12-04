<?php
session_start();
require_once("db.php");
if(isset($_SESSION['clientName'])) $clientName=$_SESSION['clientName'];
if(isset($_SESSION['clientID'])) $clientID=$_SESSION['clientID'];
if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  clientListingDetailView.php");
  }

echo
"<div><table>
    <tr>
      <th>  ListingID &nbsp;</th>
      <th>  Client Name &nbsp;</th>
      <th>  Package Origin  &nbsp;</th>
      <th>  Package Destination &nbsp;</th>
      <th>  date listed &nbsp;&nbsp;&nbsp;</th>
      <th>  Weight  (in tons)&nbsp;</th>
      <th>  rate  &nbsp;&nbsp;&nbsp;</th>
      <th>  Miles &nbsp;</th>
      <th>  Rate per Mile &nbsp; </th>
      <th>  Status &nbsp;</th>
      <th>Detail View &nbsp;</th>
    </tr>";

$sql = "select * from listing where clientID='$clientID' and clientName='$clientName'";
if(isset($_GET['originDropdown']) && !($_GET['originDropdown']=="") && !($_GET['originDropdown']=="[object Object]")) {
  $sql=$sql." and origin='".$_GET['originDropdown']."'";}

if((isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) &&
(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]"))){
  " and ratePerMile between '".$_GET['maxRPM']."' and '".$_GET['maxRPM']."'";}
elseif(isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) {
  $sql=$sql." and ratePerMile>='".$_GET['minRPM']."'";}
elseif(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]")) {
  $sql= $sql."and ratePerMile<='".$_GET['maxRPM']."'";}

if((isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) &&
(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]"))){
" and weight between '".$_GET['maxWeight']."' and '".$_GET['minWeight']."'";}
elseif(isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) {
  $sql=$sql." and weight<='".$_GET['maxWeight']."'";}
elseif(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]")) {
    $sql=$sql." and weight>='".$_GET['minWeight']."'";}


if(isset($_GET['destinationDropdown']) && !($_GET['destinationDropdown']=="") && !($_GET['destinationDropdown']=="[object Object]")) {
  $sql=$sql." and destination='".$_GET['destinationDropdown']."'";}

if((isset($_GET['minMiles'])  && !($_GET['minMiles']=="") && !($_GET['minMiles']=="[object Object]"))  &&
(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="") && !($_GET['maxMiles']=="[object Object]"))){
  " and miles between '".$_GET['maxMiles']."' and '".$_GET['minMiles']."'";}
elseif(isset($_GET['minMiles'])  && !($_GET['minMiles']=="")  &&  !($_GET['minMiles']=="[object Object]")) {
  $sql=$sql." and miles>='".$_GET['minMiles']."'";}
elseif(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="")  &&  !($_GET['maxMiles']=="[object Object]")) {
    $sql=$sql." and miles<='".$_GET['maxMiles']."'";}

$result = $mydb->query($sql);



  while($row = mysqli_fetch_array($result)) {
    echo
    "<tr>
        <td>".$row['listingID']."&nbsp</td>
        <td>".$row['clientName']."&nbsp</td>
        <td>".$row['origin']."&nbsp</td>
        <td>".$row['destination']."&nbsp</td>
        <td>".$row['dateListed']."&nbsp</td>
        <td>".$row['weight']."&nbsp</td>
        <td>$".$row['rate']."&nbsp</td>
        <td>$".$row['miles']."&nbsp</td>
        <td>$".$row['ratePerMile']."&nbsp</td>";

        if ($row['state']=="NA"){echo "<td>Needs Approval&nbsp</td>";}
        elseif($row['state']=="L"){echo "<td>Listed&nbsp</td>";}
        elseif($row['state']=="IT"){echo "<td>In Transit&nbsp</td>";}
        elseif($row['state']=="F"){echo "<td>Fulfilled&nbsp</td>";}
        elseif($row['state']=="C"){echo "<td>Canceled&nbsp</td>";}

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
