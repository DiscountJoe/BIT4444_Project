<!doctype html>
<html>
<head>
  <title>Reynholm Industries</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <p><a style="background-color: white;" href="adminLogin.php">Login</a></p>
  <?php
    session_start();
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    require_once("db.php");
    $sql = "insert into admin (lastName, email, password, firstName, type)
                 values ('$lastName', '$email', '$password', '$firstName', 'A')";
         $result=$mydb->query($sql);
         if ($result==1) {
           $sql2 = "select * from admin where email='$email' and password='$password' and firstName='$firstName' and lastName='$lastName'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new account has been added with information:</p></br>";
               echo "<div><table><thead><th>Admin ID</th><th>Email</th><th>Password</th><th>First</th><th>Last Name</th></thead>";
               echo "<td>".$row['adminID']."</td><td>$email</td><td>$password</td><td>$firstName</td><td>$lastName</td></table></div>";
                   }
         }
         else
         {
           $sql= "delete from admin where email=$email AND password=$password AND firstName=$firstName";
           $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>
</body>
</html>
