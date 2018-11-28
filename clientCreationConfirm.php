<!doctype html>
<html>
<head>
  <title>Success</title>
</head>
<body>
  <?php
    session_start();
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];
    $baseLocation = $_SESSION["baseLocation"];
    $clientName = $_SESSION["clientName"];

    require_once("db.php");

    $sql = "insert into client (clientName, email, password, baseLocation)
                 values ('$clientName', '$email', '$password', '$baseLocation')";
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from client where email='$email' and password='$password' and baseLocation='$baseLocation' and clientName='$clientName'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new product record has been added with information:</p></br>";

               echo "<table><thead><th>clientName</th><th>email</th><th>password</th><th>clientID</th><th>baseLocation</th></thead>";
               echo "<td>".$row['clientName']."</td><td>$email</td><td>$password</td><td>".$row['clientID']."</td><td>$baseLocation</td></table>";
                   }
         }
         else
         {
           $sql= "delete from client where email=$email AND password=$password AND baseLocation=$baseLocation";
           $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>

</body>
</html>
