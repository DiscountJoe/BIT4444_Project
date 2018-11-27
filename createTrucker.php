<?php
  $email = 0;
  $password = "";
  $passConfirm = "";
  $type = "C";
  $clientID = 0;
  $baseLocation = "";
  $userName = "";
  $code = "";
  $err = false;

  if (isset($_POST["submit"])) {
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["password"])) $password = $_POST["password"];
    if(isset($_POST["passConfirm"])) $passConfirm = $_POST["passConfirm"];
    if(isset($_POST["clientID"])) $clientID = $_POST["clientID"];
    if(isset($_POST["baseLocation"])) $baseLocation = $_POST["baseLocation"];
    if(isset($_POST["userName"])) $userName = $_POST["userName"];
    if(isset($_POST["code"])) $code = $_POST["code"];

    if (!empty($email) && !empty($password) && !empty($clientID) && !empty($baseLocation) && !empty($userName) && !empty($code))
    {
      session_start();
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $_SESSION["passConfirm"] = $passConfirm;
      $_SESSION["clientID"] = $clientID;
      $_SESSION["baseLocation"] = $baseLocation;
      $_SESSION["userName"] = $userName;
      $_SESSION["code"] = $code;
      header("Location: creationConfirm.php");
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

    <label>Client ID:
      <select name="clientID">
        <?php
          for ($i=1; $i <= 3 ; $i++) {
            echo "<option>$i</option>";
          }
        ?>
      </select>
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

    <label>User Name:
      <input type="text" name="userName" value="<?php echo $userName; ?>" />
      <?php
        if ($err && empty($userName)) {
          echo "<label class='errlabel'>Please enter a valid userName.</label>";
        }
      ?>
    </label>
    <br />

    <label>Code:
      <input type="text" name="code" value="<?php echo $code; ?>" />
      <?php
        if ($err && empty($code)) {
          echo "<label class='errlabel'>Please enter a valid code.</label>";
        }
      ?>
    </label>
    <br />

    <input type="submit" name="submit" value="Submit" />
</body>
