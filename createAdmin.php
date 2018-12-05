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

    if (!empty($email) && !empty($password) && !empty($firstName) && !empty($lastName) &&strcmp($password, $confirmPass))
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
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>"
    <label>email:
      <input type="text" name="email" value="<?php echo $email; ?>" />
        <?php
        if ($err && empty($email)) {
          echo "<label class='errlabel'>Please enter an email.</label>";
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
      <input type="text" name="confirmPass" value="<?php echo $confirmPass; ?>" />
      <?php
        if ($err && empty($confirmPass)) {
          echo "<label class='errlabel'>Please enter a confirmPass.</label>";
        }
      ?>
    </label>
    <br />

    <label>First Name:
      <input type="text" name="firstName" value="<?php echo $firstName; ?>" />
      <?php
        if ($err && empty($firstName)) {
          echo "<label class='errlabel'>Please enter a first name.</label>";
        }
      ?>
    </label>
    <br />

    <label>Last Name:
      <input type="text" name="lastName" value="<?php echo $lastName; ?>" />
      <?php
        if ($err && empty($lastName)) {
          echo "<label class='errlabel'>Please enter a Last Name.</label>";
        }
      ?>
    </label>
    <br />

    <input type="submit" name="submit" value="Submit" />
</body>
