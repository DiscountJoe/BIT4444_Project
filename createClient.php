<?php
  $email = "";
  $password = "";
  $passConfirm = "";
  $baseLocation = "";
  $err = false;
  $clientName = "";

  if (isset($_POST["submit"])) {
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["password"])) $password = $_POST["password"];
    if(isset($_POST["passConfirm"])) $passConfirm = $_POST["passConfirm"];
    if(isset($_POST["baseLocation"])) $baseLocation = $_POST["baseLocation"];
    if(isset($_POST["clientName"])) $clientName = $_POST["clientName"];

    if (!empty($email) && !empty($password) && !empty($baseLocation) && !empty($clientName) && strcmp($passConfirm,$password))
    {
      session_start();

      $_SESSION["clientName"] = $clientName;
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $_SESSION["passConfirm"] = $passConfirm;
      $_SESSION["baseLocation"] = $baseLocation;
      header("Location: clientCreationConfirm.php");
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
  <title>Create Client</title>
  <style>
    .errlabel {color:red;}
  </style>
</head>
<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <label>client name:
      <input type="text" name="clientName" value="<?php echo $clientName; ?>" />
      <?php
        if ($err && empty($clientName)) {
          echo "<label class='errlabel'>Please enter a valid client Name.</label>";
        }
      ?>
    </label>
    <br />
    <label>email:
      <input type="text" name="email" value="<?php echo $email; ?>" />
      <?php
        if ($err && empty($email)) {
          echo "<label class='errlabel'>Please enter a valid email.</label>";
        }
      ?>
    </label>
    <br />

    <label>password:
      <input type="text" name="password" value="<?php echo $password; ?>" />
      <?php
        if ($err && empty($password)) {
          echo "<label class='errlabel'>Please enter a password.</label>";
        }
      ?>
    </label>
    <br />

    <label>Confirm password:
      <input type="text" name="passConfirm" value="<?php echo $passConfirm; ?>" />
      <?php
        if ($err && empty($passConfirm)) {
          echo "<label class='errlabel'>Please enter the same password twice.</label>";
        }
      ?>
    </label>
    <br />

    <label>Base Location:
      <input type="text" name="baseLocation" value="<?php echo $baseLocation; ?>" />
      <?php
        if ($err && empty($baseLocation)) {
          echo "<label class='errlabel'>Please enter a Location.</label>";
        }
      ?>
    </label>
    <br />
    <input type="submit" name="submit" value="Submit" />
  </form>
</body>
