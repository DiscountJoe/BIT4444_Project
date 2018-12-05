<?php
session_start();
require_once("db.php");

if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  adminDetail.php");
  }

echo
"<table>
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

$andExists = false;

$sql = "select * from listing";
if(isset($_GET['originDropdown']) && !($_GET['originDropdown']=="") && !($_GET['originDropdown']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql=$sql."origin='".$_GET['originDropdown']."'";}

if((isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) &&
(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]"))){
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  "ratePerMile between '".$_GET['maxRPM']."' and '".$_GET['maxRPM']."'";}
elseif(isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql=$sql."ratePerMile>='".$_GET['minRPM']."'";}
elseif(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql= $sql."ratePerMile<='".$_GET['maxRPM']."'";}

if((isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) &&
(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]"))){
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
"weight between '".$_GET['maxWeight']."' and '".$_GET['minWeight']."'";}
elseif(isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql=$sql."weight<='".$_GET['maxWeight']."'";}
elseif(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
    $sql=$sql."weight>='".$_GET['minWeight']."'";}

if(isset($_GET['destinationDropdown']) && !($_GET['destinationDropdown']=="") && !($_GET['destinationDropdown']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql=$sql."destination='".$_GET['destinationDropdown']."'";}


if((isset($_GET['minMiles'])  && !($_GET['minMiles']=="") && !($_GET['minMiles']=="[object Object]"))  &&
(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="") && !($_GET['maxMiles']=="[object Object]"))){
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  "miles between '".$_GET['maxMiles']."' and '".$_GET['minMiles']."'";}
elseif(isset($_GET['minMiles'])  && !($_GET['minMiles']=="")  &&  !($_GET['minMiles']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
  $sql=$sql."miles>='".$_GET['minMiles']."'";}
elseif(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="")  &&  !($_GET['maxMiles']=="[object Object]")) {
  if($andExists==true){$sql=$sql." and ";}else{$sql=$sql." where ";}
  $andExists = true;
    $sql=$sql."miles<='".$_GET['maxMiles']."'";}

echo $sql;
$result = $mydb->query($sql);

echo
"</br><div><table>
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
elseif($row['state']=="C"){echo "<td>Cancelled</td>";}
      echo"<td><form method='post'
      action='".$_SERVER['PHP_SELF']."'>
      <input type='hidden' name='listingID' value=".$lid." />
      <input type='submit' name='submit' value='View Detail' />
      </form></td>
    </tr>";
}
  echo "</table></div>";
?>
