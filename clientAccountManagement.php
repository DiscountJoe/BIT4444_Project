<?php
session_start();
    require_once("db.php");
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
  <li><a href="clientListingsPage.php">Your Listings</a></li>
  <li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  <li><a href="clientPastLoads.php">Past Loads</a></li>
  <li><a href="createListing.php">Create Listing</a></li>
  <li class="active"><a href="clientAccountManagement.php">Manage Account</a></li>
</ul>
  <?php
    if (isset($_SESSION['clientID'])) $clientID=$_SESSION['clientID'];

      if (isset($_POST["DeleteAccount"])) {
          if(isset($_POST["clientID"])) $_SESSION['clientID']=$_POST["clientID"];
          $sql="delete from client where clientID='$clientID'";
          $mydb->query($sql);
          Header("Location:  logout.php");
        }


    $sql="select distinct * from client where clientID='$clientID'";
    $result = $mydb->query($sql);
    while($row=mysqli_fetch_array($result)){
      echo "<div style='margin-left: auto; display: block; margin-right: auto;width: 300px;'><table>
      <tr>
      <th>Client Information</th>
      <th></th>
      </tr>
  <tr>
    <td>client ID</td>
    <td>".$row['clientID']."</td>
  </tr>
  <tr>
    <td>Client Name</td>
    <td>".$row['clientName']."</td>
  </tr>
  <tr>
    <td>email</td>
    <td>".$row['email']."</td>
  </tr>
  <tr>
    <td>Base Location</td>
    <td>".$row['baseLocation']."</td>
  </tr>
  <tr>
    <td>
    </td>
    <td><form method='post'
        action='".$_SERVER['PHP_SELF']."'>
          <input type='submit' name='DeleteAccount' value='Delete Account' />
          <input type='hidden' name='clientID' value='".$row['clientID']."' />
        </form>
    </td>
  </tr>";
echo "</table></div>";
    }

   ?>
   <p><a href="logout.php">Click here to log out</a></p>
</body>
</html>
