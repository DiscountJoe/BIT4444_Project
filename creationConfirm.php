<!doctype html>
<html>
<head>
  <title>Success</title>
  <style>
    table, td {
      border: 1px solid white;
    }
    table {
      border-collapse: collapse;
      empty-cells: show;
      display:
    }
    th, td:first-child{
      color: white;
      background-color: Coral;
    }
    td {
      width: 15em;
      height: 20px;
      color: black;
      background-color: Bisque;
    }
  </style>
</head>
<body>
  <?php
    session_start();
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];
    $clientID = $_SESSION["clientID"];
    $baseLocation = $_SESSION["baseLocation"];
    $userName = $_SESSION["userName"];

    require_once("db.php");

    echo "<table>";
    echo "<thead>";
    echo "<th>email</th><th>password</th><th>clientID</th><th>baseLocation</th>
          <th>userName</th>";
    echo "</thead>";
    echo "<td>$email</td><td>$password</td><td>$clientID</td><td>$baseLocation</td>
          <td>$userName</td>";

//NEED TO FIX THIS HERE STUFF
//    if ($email == "") {
      $sql = "insert into client(email, password, clientID, baseLocation,
              userName)
              values('$email',$password, $clientID, $baseLocation,
               $userName)";
      $result=$mydb->query($sql);

      if ($result==1) {
        echo "<p>A new product record has been added.</p>";
      }
/*    } else {
      $sql = "update client set password='$password', clientID=$clientID, baseLocation=$baseLocation,
               userName=$userName
               where email=$email";
      $result=$mydb->query($sql);

      if ($result==1) {
        echo "<p>A product record has been updated.</p>";
      }
    } */
  ?>

</body>
</html>
