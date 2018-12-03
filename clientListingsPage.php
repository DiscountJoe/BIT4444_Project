<?php
session_start();

if(isset($_SESSION['clientName'])) $clientName=$_SESSION['clientName'];
if(isset($_SESSION['clientID'])) $clientID=$_SESSION['clientID'];
require_once("db.php")
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
	<body>
		<img src="reynholm.jpg" height=5% width=5% />
  	<ul class="nav nav-tabs">
  		<li><a href="clientLanding.php">Home</a></li>
  		<li class="active"><a href="clientListingsPage.php">Your Listings</a></li>
  		<li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  		<li><a href="clientPastLoads.php">Past Loads</a></li>
  		<li><a href="createListing.php">Create Listing</a></li>
		</ul>
    <div id="pieChart" style="margin: auto;
  background-color:white;
  width: 50%;
  border: 3px solid black;
  padding: 10px;"></div>

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
		    echo "<select id='originDropdown' name='originDropdown'>";
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
		    echo "<select id='destinationDropdown'>";
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
        <td><button>Reset Search</button></td>
		    <td><input type="hidden" name="state" id="state" value="" /></td>
		    <td>Maximum Miles:</td>
		    <td><input type="number" name="maxMiles" id="maxMiles" value="" /></td>
		    <td>Minimum Miles:</td>
		    <td><input type="number" name="minMiles" id="minMiles" value="" /></td>
		  </tr>
		</table>

		<script src="jquery-3.1.1.min.js"></script>
		<script>
    $(function(){
		$("#originDropdown").change(function(){
			$.ajax({url:"displayProducts.php?originDropdown="+
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
    $(function(){
		$("#destinationDropdown").change(function(){
			$.ajax({url:"displayProducts.php?originDropdown="+
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
    $(function(){
    $("#minRPM").change(function(){
      $.ajax({url:"displayProducts.php?originDropdown="+
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
    $(function(){
    		$("#minWeight").change(function(){
    			$.ajax({url:"displayProducts.php?originDropdown="+
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
        $(function(){
        $("#minMiles").change(function(){
          $.ajax({url:"displayProducts.php?originDropdown="+
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
        $(function(){
        $("#maxWeight").change(function(){
          $.ajax({url:"displayProducts.php?originDropdown="+
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
        $(function(){
        $("#maxMiles").change(function(){
          $.ajax({url:"displayProducts.php?originDropdown="+
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
        $(function(){
        $("#maxRPM").change(function(){
          $.ajax({url:"displayProducts.php?originDropdown="+
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
        $(function(){
        $("#maxMiles").change(function(){
          $.ajax({url:"displayProducts.php?originDropdown="+
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
</body>
</html>
