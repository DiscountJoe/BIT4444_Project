<?php
  $CDL = "";
  $email = "";
  $password = "";
  $passConfirm = "";
  $type = "T";
  $firstName = "";
  $lastName = "";
  $city = "";
  $state = "";
  $err = false;

  if (isset($_POST["submit"])) {
    if(isset($_POST["CDL"])) $CDL = $_POST["CDL"];
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["password"])) $password = $_POST["password"];
    if(isset($_POST["passConfirm"])) $passConfirm = $_POST["passConfirm"];
  //  if(isset($_POST["type"])) $type = $_POST["type"];
    if(isset($_POST["firstName"])) $firstName = $_POST["firstName"];
    if(isset($_POST["lastName"])) $lastName = $_POST["lastName"];
    if(isset($_POST["city"])) $city = $_POST["city"];
    if(isset($_POST["state"])) $state = $_POST["state"];

    if (!empty($CDL) && !empty($email) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($city) && !empty($state))
    {
      session_start();
      $_SESSION["CDL"] = $CDL;
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $_SESSION["passConfirm"] = $passConfirm;
      $_SESSION["type"] = $type;
      $_SESSION["firstName"] = $firstName;
      $_SESSION["lastName"] = $lastName;
      $_SESSION["city"] = $city;
      $_SESSION["state"] = $state;
      header("Location: truckerCreationConfirm.php");
    }
    else
    {
      $err = true;
    }
  }
?>

<!doctype html>

<head>
  <title>Create Client</title>
  <style>
    .errlabel {color:red;}
  </style>
</head>
<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>"

    <label>CDL:
      <input type="text" name="CDL" value="<?php if(!empty($CDL)) echo $CDL; ?>" />

    </label>
    <br />

    <label>email:
      <input type="text" name="email" value="<?php if(!empty($email)) echo $email; ?>" />

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
          echo "<label class='errlabel'>Please enter a password.</label>";
        }
      ?>
    </label>
    <br />

    <label>First Name:
      <input type="text" name="firstName" value="<?php echo $firstName; ?>" />
      <?php
        if ($err && empty($firstName)) {
          echo "<label class='errlabel'>Please enter a Location.</label>";
        }
      ?>
    </label>
    <br />

    <label>Last Name:
      <input type="text" name="lastName" value="<?php echo $lastName; ?>" />
      <?php
        if ($err && empty($lastName)) {
          echo "<label class='errlabel'>Please enter a Location.</label>";
        }
      ?>
    </label>
    <br />

    <label>City:
      <input type="text" name="city" value="<?php echo $city; ?>" />
      <?php
        if ($err && empty($city)) {
          echo "<label class='errlabel'>Please enter a valid userName.</label>";
        }
      ?>
    </label>
    <br />

    <label>State:
      <input type="text" name="state" value="<?php echo $state; ?>" />
      <?php
        if ($err && empty($state)) {
          echo "<label class='errlabel'>Please enter a valid code.</label>";
        }
      ?>
    </label>
    <br />

    <input type="submit" name="submit" value="Submit" />
</body>
