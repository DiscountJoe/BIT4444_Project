<?php
  session_start();
  require_once("db.php");
  if(isset($_SESSION["listingID"])) $listingID = $_SESSION["listingID"];
  $err=false;
  $sql="select * from listing where listingID='$listingID'";
  $result = $mydb->query($sql);
  while($row=mysqli_fetch_array($result)){
    $origin=$row['origin'];
    $destination=$row['destination'];
    $dateListed=$row['dateListed'];
    $rate=$row['rate'];
    $miles=$row['miles'];
    $weight=$row['weight'];
  }
  if (isset($_POST["submit"])) {


    if (!empty($destination) && !empty($dateListed) && !empty($weight)
        && !empty($origin) && !empty($rate))
    {
     if(isset($_POST["origin"])) $_SESSION["origin"] = $_POST["origin"];
      if(isset($_POST["destination"])) $_SESSION["destination"] = $_POST["destination"];
      if(isset($_POST["dateListed"])) $_SESSION["dateListed"] = $_POST["dateListed"];
      if(isset($_POST["rate"])) $_SESSION["rate"] = $_POST["rate"];
      if(isset($_POST["miles"])) $_SESSION["miles"] = $_POST["miles"];
      if(isset($_POST["weight"])) $_SESSION["weight"] = $_POST["weight"];
      header("Location: editListingConfirm.php");
    }
    else
    {
      $err = true;
    }
  }
?>

<html>
<script>
document.getElementById('datePicker').value = new Date().toDateInputValue();
</script>
<head>
  <title>Edit Listing</title>
  <style>
    .errlabel {color:red;}
  </style>
</head>
<body>
  <nav>
    <img src="reynholm.jpg" height="5%" width="5%">
    <a href="clientLanding.php">Home</a>
      <a href="clientListingsPage.php">All Loads</a>
      <a href="clientCurrentLoads.php">My Current Loads</a>
      <a href="clientPastLoads.php">My Past Loads</a>
</nav>
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
      <input type="date" name="dateListed" id="datePicker" />
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
      <input type="text" name="weight" value="<?php echo $weight; ?>" />
      <?php
        if ($err && empty($weight)) {
          echo "<label class='errlabel'>Please enter a Location.</label>";
        }
      ?>
    </label>
    <br />
    <input type="submit" name="submit" value="submit" />
  </form>
</body>

</html>
