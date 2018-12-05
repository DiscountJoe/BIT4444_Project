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
    "<div style='margin-left: auto; display: block; margin-right: auto;width: 1200px;'>
<table>
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

$conditions = "where clientID='$clientID' and clientName='$clientName'";
if(isset($_GET['originDropdown']) && !($_GET['originDropdown']=="") && !($_GET['originDropdown']=="[object Object]")) {
  $conditions=$conditions." and origin='".$_GET['originDropdown']."'";}

if((isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) &&
(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]"))){
  $conditions=$conditions." and ratePerMile between '".$_GET['minRPM']."' and '".$_GET['maxRPM']."'";
echo "rpmworks";}
elseif(isset($_GET['minRPM']) && !($_GET['minRPM']=="") && !($_GET['minRPM']=="[object Object]")) {
  $conditions=$conditions." and ratePerMile>='".$_GET['minRPM']."'";}
elseif(isset($_GET['maxRPM']) && !($_GET['maxRPM']=="") && !($_GET['maxRPM']=="[object Object]")) {
  $conditions= $conditions."and ratePerMile<='".$_GET['maxRPM']."'";}

if((isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) &&
(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]"))){
$conditions=$conditions." and weight between '".$_GET['minWeight']."' and '".$_GET['maxWeight']."'";
echo "weightworks";}
elseif(isset($_GET['maxWeight']) && !($_GET['maxWeight']=="") && !($_GET['maxWeight']=="[object Object]")) {
  $conditions=$conditions." and weight<='".$_GET['maxWeight']."'";}
elseif(isset($_GET['minWeight']) && !($_GET['minWeight']=="") && !($_GET['minWeight']=="[object Object]")) {
    $conditions=$conditions." and weight>='".$_GET['minWeight']."'";}


if(isset($_GET['destinationDropdown']) && !($_GET['destinationDropdown']=="") && !($_GET['destinationDropdown']=="[object Object]")) {
  $conditions=$conditions." and destination='".$_GET['destinationDropdown']."'";}

if((isset($_GET['minMiles'])  && !($_GET['minMiles']=="") && !($_GET['minMiles']=="[object Object]"))  &&
(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="") && !($_GET['maxMiles']=="[object Object]"))){
  $conditions=$conditions." and miles between '".$_GET['minMiles']."' and '".$_GET['maxMiles']."'";
echo "milesworks";}
elseif(isset($_GET['minMiles'])  && !($_GET['minMiles']=="")  &&  !($_GET['minMiles']=="[object Object]")) {
  $conditions=$conditions." and miles>='".$_GET['minMiles']."'";}
elseif(isset($_GET['maxMiles'])  && !($_GET['maxMiles']=="")  &&  !($_GET['maxMiles']=="[object Object]")) {
    $conditions=$conditions." and miles<='".$_GET['maxMiles']."'";}

if(isset($_GET['state'])  && !($_GET['state']=="")  &&  !($_GET['state']=="[object Object]")) {
        $conditions=$conditions." and state='".$_GET['state']."'";}

        $sql="select * from listing ".$conditions;
?>
<html>
<head>
</head>
<body style="background-color:skyblue;">


<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>
d3pie.destroy("pieChart");
</script>
<div id="pieChart" style="margin: auto;
background-color:white;
width: 625px;
border: 3px solid black;
padding: 10px;"></div>
<script>
var pie = new d3pie("pieChart", {
"header": {
  "title": {
    "text": "Current Query Composition",
    "fontSize": 20,
    "font": "open sans"
  },
  "subtitle": {
    "text": "by fulfillment status",
    "color": "#999999",
    "font": "open sans"
  },
  "titleSubtitlePadding": 9
},
"footer": {
  "color": "#999999",
  "fontSize": 10,
  "font": "open sans",
  "location": "bottom-left"
},
"size": {
  "canvasWidth": 590,
  "pieInnerRadius": "40%",
  "pieOuterRadius": "63%"
},
"data": {
  "sortOrder": "value-desc",
  "content": [
    {
      "label": "Needs Approval",
      "value": <?php $sql2=("select count(state) as total from listing ".$conditions." and state='NA'");
      $result = $mydb->query($sql2);
      while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
      "color": "#1c6898"
    },
    {
      "label": "Listed",
      "value": <?php $sql2=("select count(state) as total from listing ".$conditions." and state='L'");
      $result = $mydb->query($sql2);
      while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
      "color": "#a39216"
    },
    {
      "label": "In-Transit",
      "value": <?php $sql2=("select count(state) as total from listing ".$conditions." and state='IT'");
      $result = $mydb->query($sql2);
      while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
      "color": "#1628a4"
    },
    {
      "label": "Fulfilled",
      "value": <?php $sql2=("select count(state) as total from listing ".$conditions." and state='F'");
      $result = $mydb->query($sql2);
      while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
      "color": "#12bd09"
    },
    {
      "label": "Cancelled",
      "value": <?php $sql2=("select count(state) as total from listing ".$conditions." and state='C'");
      $result = $mydb->query($sql2);
      while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
      "color": "#a11818"
    }
  ]
},
"labels": {
  "outer": {
    "pieDistance": 32
  },
  "inner": {
    "hideWhenLessThanPercentage": 3
  },
  "mainLabel": {
    "fontSize": 11
  },
  "percentage": {
    "color": "#ffffff",
    "decimalPlaces": 0
  },
  "value": {
    "color": "#adadad",
    "fontSize": 11
  },
  "lines": {
    "enabled": true
  },
  "truncation": {
    "enabled": true
  }
},
"effects": {
  "pullOutSegmentOnClick": {
    "effect": "linear",
    "speed": 400,
    "size": 8
  }
},
"misc": {
  "gradient": {
    "enabled": true,
    "percentage": 100
  }
}
});</script>
</body>
</html>
<?php
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
