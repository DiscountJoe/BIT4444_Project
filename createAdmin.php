<?php
  $email = "";
  $password = "";
  $confirmPass = "";
  $firstName = "";
  $lastName = "";
  $type = "A";
  $err = false;

  if (isset($_POST["submit"])) {
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["password"])) $password = $_POST["password"];
    if(isset($_POST["firstName"])) $firstName = $_POST["firstName"];
    if(isset($_POST["lastName"])) $lastName = $_POST["lastName"];

    if (!empty($email) && !empty($password) && !empty($firstName) && !empty($lastName))
    {
      session_start();
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $_SESSION["firstName"] = $firstName;
      $_SESSION["lastName"] = $lastName;
      header("Location: adminCreationConfirm.php");
    }
    else
    {
      $err = true;
    }
  }
?>

<!doctype html>

<head>
  <title>Create Admin</title>
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
      <input type="text" name="firstName" value="<?php echo $firstName; ?>" />
      <?php
        if ($err && empty($firstName)) {
          echo "<label class='errlabel'>Please enter a password.</label>";
        }
      ?>
    </label>
    <br />

    <label>First Name:
      <input type="text" name="$firstName" value="<?php echo $firstName; ?>" />
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
          echo "<label class='errlabel'>Please enter a valid userName.</label>";
        }
      ?>
    </label>
    <br />

    <input type="submit" name="submit" value="Submit" />
</body>
