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
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    require_once("db.php");
    $sql = "insert into admin (lastName, email, password, firstName)
                 values ('$lastName', '$email', '$password', '$firstName')";
         $result=$mydb->query($sql);
         if ($result==1) {
           $sql2 = "select * from admin where email='$email' and password='$password' and firstName='$firstName' and lastName='$lastName'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new product record has been added with information:</p></br>";
               echo "<table><thead><th>lastName</th><th>email</th><th>password</th><th>clientID</th><th>firstName</th></thead>";
               echo "<td>".$row['lastName']."</td><td>$email</td><td>$password</td><td>"."</td><td>$firstName</td></table>";
                   }
         }
         else
         {
           $sql= "delete from client where email=$email AND password=$password AND firstName=$firstName";
           $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>

</body>
</html>
