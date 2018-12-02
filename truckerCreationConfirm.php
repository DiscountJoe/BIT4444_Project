<?php

  session_start();
    $CDL = $_SESSION["CDL"];
  $email = $_SESSION["email"];
  $password = $_SESSION["password"];
  $firstName = $_SESSION["firstName"];
  $lastName = $_SESSION["lastName"];
  $city = $_SESSION["city"];
  $state = $_SESSION["state"];

?>
<html>
<head>
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
      <img src="reynholm.jpg" height=5% width=5% />
  
  <?php
    require_once("db.php");

    $sql = "insert into trucker (CDL, email, password, firstName, lastName, city, state)
                 values ('$CDL', '$email', '$password', '$firstName', '$lastName', '$city', '$state')";
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from trucker where CDL='$CDL'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new product record has been added with information:</p></br>";

               echo "<table><thead><th>CDL</th><th>email</th><th>password</th><th>firstName</th><th>lastName</th></thead>";
               echo "<td>".$row['CDL']."</td><td>$email</td><td>$password</td><td>".$row['firstName']."</td><td>$lastName</td></table>";
                   }
         }
         else
         {
           $sql= "delete from trucker where email=$email AND password=$password AND baseLocation=$baseLocation";
           $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>

</body>
</html>
