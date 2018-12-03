<?php
session_start();

require_once("db.php");
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
  <li><a href="clientLanding.php">Home</a></li>
  <li class="active"><a href="clientListingsPage.php">Your Listings</a></li>
  <li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  <li><a href="clientPastLoads.php">Past Loads</a></li>
  <li><a href="createListing.php">Create Listing</a></li>
</ul>

  <p><div id="pieChart" style="margin: auto;
  background-color:white;
  width: 50%;
  border: 3px solid black;
  padding: 10px;"></div></p>

<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>
var pie = new d3pie("pieChart", {
	"header": {
		"title": {
			"text": "All <?php echo $clientName ?> Listings",
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
				"value": <?php $sql=("select count(state) as total from listing where clientID='$clientID' and state='NA'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#1c6898"
			},
			{
				"label": "Listed",
				"value": <?php $sql=("select count(state) as total from listing where clientID='$clientID' and state='L'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#a39216"
			},
			{
				"label": "In-Transit",
				"value": <?php $sql=("select count(state) as total from listing where clientID='$clientID' and state='IT'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#1628a4"
			},
			{
				"label": "Fulfilled",
				"value": <?php $sql=("select count(state) as total from listing where clientID='$clientID' and state='F'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#12bd09"
			},
			{
				"label": "Cancelled",
				"value": <?php $sql=("select count(state) as total from listing where clientID='$clientID' and state='C'");
        $result = $mydb->query($sql);
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
});
</script>


<table>
  <tr>
    <td>Origin:</td>
    <td><?php
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
    <td><input type="hidden" name="state" value="" /></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>

<?php
$sql = "select * from listing where clientID='$clientID' and clientName='$clientName'";
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
  echo "</div></table>";
?>

<div id='contentArea'></div>
<p><a href="logout.php">Click here to log out</a></p>

</body>
</html>
