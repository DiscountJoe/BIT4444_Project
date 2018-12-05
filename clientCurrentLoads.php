<?php
session_start();

if(isset($_SESSION['clientName'])) $clientName=$_SESSION['clientName'];
if(isset($_SESSION['clientID'])) $clientID=$_SESSION['clientID'];
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
  <meta charset="utf-8">
</head>
	<body onload="clearAll()">
		<img src="reynholm.jpg" height=5% width=5% />
  	<ul class="nav nav-tabs">
  		<li><a href="clientLanding.php">Home</a></li>
  		<li><a href="clientListingsPage.php">Your Listings</a></li>
  		<li class="active"><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  		<li><a href="clientPastLoads.php">Past Loads</a></li>
  		<li><a href="createListing.php">Create Listing</a></li>
		</ul>


<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>

function clearAll()
{document.getElementById("originDropdown").innerHTML="<?php
$sql="select distinct origin from listing where clientID='$clientID'";
$result = $mydb->query($sql);
echo "<select id='originDropdown' name='originDropdown'><option value=''></option>";
while($row=mysqli_fetch_array($result)){
  $Selection=$row["origin"];
  echo "<option value = '$Selection'>$Selection</option>";
}
echo "</select>";
?>";

document.getElementById("destinationDropdown").innerHTML="<?php
$sql="select distinct destination from listing where clientID='$clientID'";
$result = $mydb->query($sql);
echo "<select id='destinationDropdown'><option value=''></option>";
while($row=mysqli_fetch_array($result)){
  $Selection=$row["destination"];
  echo "<option value = '$Selection'>$Selection</option>";
}
echo "</select>";
?>"
$(function(){
  $.ajax({url:"clientListingsPageBackend.php?originDropdown="+
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
}
</script>
<div style="left-margin:auto;right-margin:auto;display:block;width:850px;">

		<table style="text-align:center;left-margin:auto;right-margin:auto;display:block;">
		  <tr>
		    <td>Origin:</td>
		    <td><?php
		    $sql="select distinct origin from listing where clientID='$clientID'";
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
		    $sql="select distinct destination from listing where clientID='$clientID'";
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
        <td><input type="hidden" name="state" id="state" value="IT" /></td>
		    <td><button id="resetSearch" name="resetSearch" onclick="clearAll();">Reset Search</button></td>
		    <td>Maximum Miles:</td>
		    <td><input type="number" name="maxMiles" id="maxMiles" value="" /></td>
		    <td>Minimum Miles:</td>
		    <td><input type="number" name="minMiles" id="minMiles" value="" /></td>
		  </tr>
		</table>

  </div>
		<script src="jquery-3.1.1.min.js"></script>
		<script>

        $(function(){
        $("#maxMiles, #maxRPM, #maxMiles, #maxWeight, #minMiles, #minWeight, #minRPM, #destinationDropdown, #originDropdown").change(function(){
          $.ajax({url:"clientListingsPageBackend.php?originDropdown="+
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
        $(function(){
        $("#resetSearch").onclick(function(){
          $.ajax({url:"clientListingsPageBackend.php?originDropdown="+
          $("#originDropdown").val()+"&maxRPM="+
          $("#maxRPM").val()+"&maxWeight="+
          $("#maxWeight").val()+
          "&destinationDropdown="+
          $("#destinationDropdown").val()+
          "&minRPM="+$("#minRPM").val()+
          "&minWeight="+$("#minWeight").val()+
          "&dateListed="+$("#dateListed")+
          "&minMiles="+$("#minMiles")+
          "&maxMiles="+$("#maxMiles")+
          "&state="+$("#state"),
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
  <a style="background-color:white;" href="logout.php">Click here to log out</a>
</p>
</body>
</html>
