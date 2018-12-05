<?php
session_start();

require_once("db.php");

if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  clientListingDetailView.php");
  }
?>

<html lang="en" dir="ltr">
<head>
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <body onload="clearAll()">
      <img src="reynholm.jpg" height=5% width=5% />
  <ul class="nav nav-tabs">
  <li><a href="adminLanding.php">Home</a></li>
  <li class="active"><a href="aminViewListings.php">View Listings</a></li>
  <li><a href="moderationNew.php">Moderation</a></li>
    <li><a href="adminViewCurrentListings.php">View Current Listings</a></li>
    <li><a href="adminAreYouSure.php">Delete your Account</a></li>

</ul>

<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<div style="margin-left:auto; margin-right:auto; width:50%;" id="pieChart"></div>

<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>
var pie = new d3pie("pieChart", {
	"header": {
		"title": {
			"text": "All Listings",
			"fontSize": 34,
			"font": "courier"
		},
		"subtitle": {
			"text": "By Status",
			"color": "#999999",
			"fontSize": 10,
			"font": "courier"
		},
		"location": "pie-center",
		"titleSubtitlePadding": 10
	},
	"footer": {
		"color": "#999999",
		"fontSize": 10,
		"font": "open sans",
		"location": "bottom-left"
	},
	"size": {
		"canvasWidth": 590,
		"pieInnerRadius": "69%",
		"pieOuterRadius": "98%"
	},
	"data": {
		"sortOrder": "label-desc",
		"content": [
			{
				"label": "Listed",
				"value":  <?php $sql=("select count(state) as total from listing where state='L'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#f5c2c2"
			},
			{
				"label": "In Transit",
				"value":  <?php $sql=("select count(state) as total from listing where state='IT'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#f5c2cb"
			},
			{
				"label": "Needs Approval",
				"value":  <?php $sql=("select count(state) as total from listing where state='NA'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#f5c2d4"
			},
			{
				"label": "Cancelled",
				"value":  <?php $sql=("select count(state) as total from listing where state='C'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#f5c2de"
			},
			{
				"label": "Fulfilled",
				"value":  <?php $sql=("select count(state) as total from listing where state='F'");
        $result = $mydb->query($sql);
        while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
				"color": "#f5c2e7"
			}
		]
	},
	"labels": {
		"outer": {
			"format": "label-percentage1",
			"pieDistance": 20
		},
		"inner": {
			"format": "none"
		},
		"mainLabel": {
			"fontSize": 11
		},
		"percentage": {
			"color": "#999999",
			"fontSize": 11,
			"decimalPlaces": 0
		},
		"value": {
			"color": "#cccc43",
			"fontSize": 11
		},
		"lines": {
			"enabled": true,
			"color": "#777777"
		},
		"truncation": {
			"enabled": true
		}
	},
	"effects": {
		"pullOutSegmentOnClick": {
			"speed": 400,
			"size": 8
		}
	},
	"misc": {
		"colors": {
			"segmentStroke": "#000000"
		}
	},
	"callbacks": {
		"onMouseoverSegment": null,
		"onMouseoutSegment": null,
		"onClickSegment": null
	}
});
</script>
<script>

function clearAll()
{document.getElementById("originDropdown").innerHTML="<?php
$sql="select distinct origin from listing";
$result = $mydb->query($sql);
echo "<select id='originDropdown' name='originDropdown'><option value=''></option>";
while($row=mysqli_fetch_array($result)){
  $Selection=$row["origin"];
  echo "<option value = '$Selection'>$Selection</option>";
}
echo "</select>";
?>";

document.getElementById("destinationDropdown").innerHTML="<?php
$sql="select distinct destination from listing";
$result = $mydb->query($sql);
echo "<select id='destinationDropdown'><option value=''></option>";
while($row=mysqli_fetch_array($result)){
  $Selection=$row["destination"];
  echo "<option value = '$Selection'>$Selection</option>";
}
echo "</select>";
?>"
$(function(){
  $.ajax({url:"adminViewListingsBackend.php?originDropdown="+
  $("#originDropdown").val()+"&maxRPM="+
  $("#maxRPM").val()+"&maxWeight="+
  $("#maxWeight").val()+
  "&destinationDropdown="+
  $("#destinationDropdown").val()+
  "&minRPM="+$("#minRPM").val()+
  "&minWeight="+$("#minWeight").val()+
  "&dateListed="+$("#dateListed").val()+
  "&minMiles="+$("#minMiles").val()+
  "&maxMiles="+$("#maxMiles").val()+
  "&state="+$("#state").val(),
    async:true,
    success:function(result){
      $("#contentArea").html(result);
    }
  })
})}
</script>
		<table style="left-margin:auto;right-margin:auto;display:block;">
		  <tr>
		    <td>Origin:</td>
		    <td><?php
		    $sql="select distinct origin from listing";
		    $result = $mydb->query($sql);
		    echo "<select id='originDropdown' name='originDropdown'><option value=''></option>";
		    while($row=mysqli_fetch_array($result)){
		      $Selection=$row["origin"];
		      echo "<option value = '$Selection'>$Selection</option>";
		    }
		    echo "</select>";
		    ?></td>
		    <td>Maximum Rate/Mile:</td>
		    <td><input type="number" id="maxRPM" name="maxRPM" value="" /></td>
        <td>Minimum Rate/Mile:</td>
       <td><input type="number" name="minRPM" id="minRPM" value="" /></td>

		  </tr>
		  <tr>
		    <td>Destination:</td>
		    <td><?php
		    $sql="select distinct destination from listing";
		    $result = $mydb->query($sql);
		    echo "<select id='destinationDropdown'><option value=''></option>";
		    while($row=mysqli_fetch_array($result)){
		      $Selection=$row["destination"];
		      echo "<option value = '$Selection'>$Selection</option>";
		    }
		    echo "</select>";
		    ?></td>
        <td>Maximum Weight:</td>
        <td><input type="number" id="maxWeight" name="maxWeight" value="" /></td>
		    <td>Minimum Weight:</td>
		    <td><input type="number" id="minWeight" name="minWeight" value="" /></td>
		  </tr>
		  <tr>
        <td><input type="hidden" name="state" id="state" value="" /></td>
		    <td><button id="resetSearch" onclick="clearAll();">Reset Search</button></td>
		    <td>Maximum Miles:</td>
		    <td><input type="number" name="maxMiles" id="maxMiles" value="" /></td>
		    <td>Minimum Miles:</td>
		    <td><input type="number" name="minMiles" id="minMiles" value="" /></td>
		  </tr>
		</table>

		<script src="jquery-3.1.1.min.js"></script>
		<script>

    $(function(){
    $("#originDropdown, #destinationDropdown, #minRPM, #minWeight, #minMiles, #maxWeight, #maxMiles, #maxRPM").change(function(){
      $.ajax({url:"adminViewListingsBackend.php?originDropdown="+
      $("#originDropdown").val()+"&maxRPM="+
      $("#maxRPM").val()+"&maxWeight="+
      $("#maxWeight").val()+
      "&destinationDropdown="+
      $("#destinationDropdown").val()+
      "&minRPM="+$("#minRPM").val()+
      "&minWeight="+$("#minWeight").val()+
      "&dateListed="+$("#dateListed").val()+
      "&minMiles="+$("#minMiles").val()+
      "&maxMiles="+$("#maxMiles").val()+
      "&state="+$("#state").val(),
        async:true,
        success:function(result){
          $("#contentArea").html(result);
        }
      })
    })
    })

</script>

<div id="contentArea"></div>
<p style='margin-left: auto; display: block; margin-right: auto;'>
  <a href="logout.php">Click here to log out</a>
</p>
</body>
</html>
