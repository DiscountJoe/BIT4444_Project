<?php
  $email="";
  $password="";
  $remember="no";
  $error = false;
  $loginOK = null;

  if(isset($_POST["submit"])){
    if(isset($_POST["email"])) $email=$_POST["email"];
    if(isset($_POST["password"])) $password=$_POST["password"];
    if(isset($_POST["remember"])) $remember=$_POST["remember"];

    //echo ($email.".".$password.".".$remember);
    if(empty($email) || empty($password)) {
      $error=true;
    }

    //set cookies for remembering the user name
    if(!empty($email) && $remember=="yes"){
      setcookie("email", $email, time()+60*60*24, "/");
    }

    if(!$error){
      //check email and password with the database record
      require_once("db.php");
      $sql = "select password from accounts where email='$email'";
      $result = $mydb->query($sql);

      $row=mysqli_fetch_array($result);
      if ($row){
        if(strcmp($password, $row["password"]) ==0 ){
          $loginOK=true;
        } else {
          $loginOK = false;
        }
      }

      $sql = "select type from accounts where email='$email'";
      $result = $mydb->query($sql);

      $row=mysqli_fetch_array($result);
      if($loginOK && $row["type"]=="T") {
        //set session variable to remember the email
        session_start();
        $_SESSION["email"] = $email;
        setcookie("password", $password, time()+86400*3);

        Header("Location:truckerLanding.php");
      }
      if($loginOK && $row["type"]=="C") {
        //set session variable to remember the email
        session_start();
        $_SESSION["email"] = $email;
        setcookie("password", $password, time()+86400*3);

        Header("Location:clientLanding.php");
      }
      if($loginOK && $row["type"]=="A") {
        //set session variable to remember the email
        session_start();
        $_SESSION["email"] = $email;
        setcookie("password", $password, time()+86400*3);

        Header("Location:adminLanding.php");
      }
    }
  }

 ?>
<!doctype html>
<html>
<head>
  <title>Login</title>
  <style>
    .errlabel {color:red};
  </style>
</head>
<body>
  <img src="reynholm.jpg" height="5%" width="5%">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <table>
      <tr>
        <td>email</td>
      </tr>
      <tr>
        <td><input type="text" name="email" value="<?php
          if(!empty($email))
            echo $email;
          else if(isset($_COOKIE['email'])) {
            echo $_COOKIE['email'];
          }
        ?>" /><?php if($error && empty($email)) echo "<span class='errlabel'> please enter a email</span>"; ?></td>
      </tr>
      <tr>
        <td>password</td>
      </tr>
      <tr>
        <td><input type="password" name="password" value="<?php if(!empty($password)) echo $password; ?>" /><?php if($error && empty($password)) echo "<span class='errlabel'> please enter a password</span>"; ?></td>
      </tr>
    </table>


    <table>
      <tr>
        <td><input type="checkbox" name="remember" value="yes"/><label>Remember me</label></td>
      </tr>
      <tr>
        <td><?php if(!is_null($loginOK) && $loginOK==false) echo "<span class='errlabel'>email and password do not match.</span>"; ?></td>
      </tr>
      <tr>
        <td><input type="submit" name="submit" value="Login" /></td>
      </tr>
    </table>
  </form>

<a href="create.html">Create an account.</a>
</body>
</html>
