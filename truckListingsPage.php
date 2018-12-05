<?php
session_start();

if(isset($_SESSION['CDL'])) $CDL=$_SESSION['CDL'];
require_once("db.php");

if (isset($_POST["submit"])) {
    if(isset($_POST["listingID"])) $_SESSION['listingID']=$_POST["listingID"];
    Header("Location:  truckerDetail.php");
  }
?>

<html lang="en" dir="ltr">
<head>
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
</head>
	<body "clearAll()">
		<img src="reynholm.jpg" height=5% width=5% />
  	<<ul class="nav nav-tabs">
  		<li><a href="truckerLanding.php">Home</a></li>
  		<li class="active"><a href="clientListingsPage.php">Your Listings</a></li>
  		<li><a href="myTruckerLoads.php">My loads</a></li>
  		<li><a href="pastTruckerLoads.php">Past Loads</a></li>
		</ul>
    <div id="pieChart"></div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
    <script src="d3pie.min.js"></script>
    <script>
    var pie = new d3pie("pieChart", {
    	"header": {
    		"title": {
    			"text": "All <?php echo $CDL ?> Listings",
    			"fontSize": 24,
    			"font": "open sans"
    		},
    		"subtitle": {
    			"text": "by fulfillment status",
    			"color": "#999999",
    			"fontSize": 12,
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
    		"pieOuterRadius": "90%"
    	},
    	"data": {
    		"sortOrder": "value-desc",
    		"content": [
    			{
    				"label": "Needs Approval",
            "value": <?php $sql=("select count(state) as total from listing where CDL='$CDL' and state='NA'");
            $result = $mydb->query($sql);
            while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
    				"color": "#1c6898"
    			},
    			{
    				"label": "Listed",
            "value": <?php $sql=("select count(state) as total from listing where CDL='$CDL' and state='L'");
            $result = $mydb->query($sql);
            while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
            "color": "#a39216"
    			},
    			{
    				"label": "In Transit",
            "value": <?php $sql=("select count(state) as total from listing where CDL='$CDL' and state='IT'");
            $result = $mydb->query($sql);
            while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
    				"color": "#1628a4"
    			},
    			{
    				"label": "Fulfilled",
            "value": <?php $sql=("select count(state) as total from listing where CDL='$CDL' and state='F'");
            $result = $mydb->query($sql);
            while($row=mysqli_fetch_array($result)){echo $row['total'];}?>,
    				"color": "#12bd09"
    			},
    			{
    				"label": "Cancelled",
            "value": <?php $sql=("select count(state) as total from listing where CDL='$CDL' and state='C'");
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
document.getElementById("pieChart").innerHTML="";
$(function(){
  $.ajax({url:"truckListingsPageBackend.php?originDropdown="+
  $("#originDropdown").val()+"&maxRPM="+
  $("#maxRPM").val()+"&maxWeight="+
  $("#maxWeight").val()+
  "&destinationDropdown="+
  $("#destinationDropdown").val()+
  "&minRPM="+$("#minRPM").val()+
  "&minWeight="+$("#minWeight").val()+
  "&minMiles="+$("#minMiles").val()+
  "&maxMiles="+$("#maxMiles").val()+
  "&state="+$("#state").val(),
    async:true,
    success:function(result){
      $("#contentArea").html(result);
    }
  })
})
}</script>
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
		    ?></td>0
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
		    <td><button id="resetSearch" name="resetSearch" onclick="clearAll();">Reset Search</button></td>
		    <td>Maximum Miles:</td>
		    <td><input type="number" name="maxMiles" id="maxMiles" value="" /></td>
		    <td>Minimum Miles:</td>
		    <td><input type="number" name="minMiles" id="minMiles" value="" /></td>
		  </tr>
		</table>

		<script src="jquery-3.1.1.min.js"></script>
		<script>

        $(function(){
        $("#maxMiles, #maxRPM, #maxMiles, #maxWeight, #minMiles, #minWeight, #minRPM, #destinationDropdown, #originDropdown").change(function(){
          $.ajax({url:"truckListingsPageBackend.php?originDropdown="+
          $("#originDropdown").val()+"&maxRPM="+
          $("#maxRPM").val()+"&maxWeight="+
          $("#maxWeight").val()+
          "&destinationDropdown="+
          $("#destinationDropdown").val()+
          "&minRPM="+$("#minRPM").val()+
          "&minWeight="+$("#minWeight").val()+
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
