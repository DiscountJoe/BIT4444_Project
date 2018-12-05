<?php
  session_start();
  $destination = "";
  $dateListed = "";
  $rate = "";
  $weight = "";
  $err = false;
  $origin = "";
  $miles = "";
  $clientID="200";

  if (isset($_POST['submit'])) {
    if(isset($_POST['destination'])) $destination = $_POST['destination'];
    if(isset($_POST['dateListed'])) $dateListed = $_POST['dateListed'];
    if(isset($_POST['rate'])) $rate = $_POST['rate'];
    if(isset($_POST['weight'])) $weight = $_POST['weight'];
    if(isset($_POST['origin'])) $origin = $_POST['origin'];
    if(isset($_POST['miles'])) $miles = $_POST['miles'];
    if(isset($_POST['clientName'])) $clientName = $_SESSION['clientName'];
    if(isset($_SESSION['clientID'])) $clientID = $_SESSION['clientID'];

    if (!empty($destination) && !empty($dateListed) && !empty($weight)
        && !empty($origin))
    {

      $_SESSION['origin'] = $origin;
      $_SESSION['destination'] = $destination;
      $_SESSION['dateListed'] = $dateListed;
      $_SESSION['rate'] = $rate;
      $_SESSION['weight'] = $weight;
      $_SESSION['clientID'] = $clientID;
      $_SESSION['miles']= $miles;
      $_SESSION['clientName']=$clientName;

      header("Location: listingCreationConfirm.php");
    }
    else
    {
      $err = true;
    }
  }
?>

<!doctype html>
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
  <li class="active"><a href="createListing.php">Create Listing</a></li>
</ul>
    <div style='margin-left: auto; display: block; margin-right: auto;width: 300px;'>
      ENTER NEW LISTING INFORMATION
    </br>
  </br>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <label>origin:
      <input type="text" name="origin" value="<?php echo $origin; ?>" />
      <?php
        if ($err && empty($origin)) {
          echo "<label class='errlabel'>Please enter a valid origin.</label>";
        }
      ?>
    </label>
    <br />
    <label>destination:
      <input type="text" name="destination" value="<?php echo $destination; ?>" />
      <?php
        if ($err && empty($destination)) {
          echo "<label class='errlabel'>Please enter a valid destination.</label>";
        }
      ?>
    </label>
    <br />

    <label>dateListed:
      <input type="date" name="dateListed" value="<?php echo date('Y-m-d'); ?>"min="<?php echo date('Y-m-d'); ?>" max="2018-12-31"/>
      <?php
        if ($err && empty($dateListed)) {
          echo "<label class='errlabel'>Please enter a dateListed.</label>";
        }
      ?>
    </label>
    <br />

    <label>rate:
      <input type="number" name="rate" value="<?php echo $rate; ?>" />
      <?php
        if ($err && empty($rate)) {
          echo "<label class='errlabel'>Please enter a proper rate.</label>";
        }
      ?>
    </label>
    <br />
    <label>miles:
      <input type="number" name="miles" value="<?php echo $miles; ?>" />
      <?php
        if ($err && empty($miles)) {
          echo "<label class='errlabel'>Please enter a proper number of miles.</label>";
        }
      ?>
    </label>
    <br />

    <label>weight:
      <input type="number" name="weight" value="<?php echo $weight; ?>" />
      <?php
        if ($err && empty($weight)) {
          echo "<label class='errlabel'>Please enter a Location.</label>";
        }
      ?>
    </label>
    <br />
    <input type="hidden" name="clientName" value=<?php $clientName ?>/>
    <input type="submit" name="submit" value="Submit" />
  </form>

</div>
<p style='margin-left: auto; display: block; margin-right: auto;'>
  <a style="background-color:white;" href="logout.php">Click here to log out</a>
</p>
</body>
