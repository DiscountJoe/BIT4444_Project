<?php

  session_start();
  $email = $_SESSION["email"];
  $password = $_SESSION["password"];
  $baseLocation = $_SESSION["baseLocation"];
  $clientName = $_SESSION["clientName"];

?>
<html>
<head>
  <title>Reynholm Industries</title>
<link rel="stylesheet" href="stylesheet.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
      <img src="reynholm.jpg" height=5% width=5% />
  <ul class="nav nav-tabs">
  <li class="active"><a href="clientLanding.php">Home</a></li>
  <li><a href="clientListingsPage.php">Your Listings</a></li>
  <li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  <li><a href="clientPastLoads.php">Past Loads</a></li>
  <li><a href="createListing.php">Create Listing</a></li>
  <li><a href="clientAccountManagement.php">Manage Account</a></li>
</ul>
  <?php
    require_once("db.php");

    $sql = "insert into client (clientName, email, password, baseLocation, userName)
                 values ('$clientName', '$email', '$password', '$baseLocation', 'swordfish')";
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from client where email='$email' and password='$password' and baseLocation='$baseLocation' and clientName='$clientName'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new product record has been added with information:</p></br>";

               echo "<table style="background-color:white;"><thead><th>clientName</th><th>email</th><th>password</th><th>clientID</th><th>baseLocation</th></thead>";
               echo "<td>".$row['clientName']."</td><td>$email</td><td>$password</td><td>".$row['clientID']."</td><td>$baseLocation</td></table>";
               $_SESSION['clientID']=$row['clientID'];
                   }
         }
         else
         {
           $sql= "delete from client where email=$email AND password=$password AND baseLocation=$baseLocation";
           $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>
  <p><a href="logout.php">Click here to log out</a></p>

</body>
</html>
