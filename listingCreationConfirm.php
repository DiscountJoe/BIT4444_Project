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
      <img src="reynholm.jpg" height=5% width=5% />
  <ul class="nav nav-tabs">
  <li><a href="clientLanding.php">Home</a></li>
  <li><a href="clientListingsPage.php">Your Listings</a></li>
  <li><a href="clientCurrentLoads.php">Loads in Transit</a></li>
  <li><a href="clientPastLoads.php">Past Loads</a></li>
  <li><a href="createListing.php">Create Listing</a></li>
</ul>
  <?php
    session_start();
    $state = "NA";//needs approval
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";//not applicable


    if(isset($_SESSION['destination']))$destination = $_SESSION['destination'];
    if(isset($_SESSION['dateListed']))$dateListed = $_SESSION['dateListed'];
    if(isset($_SESSION['weight']))$weight = $_SESSION['weight'];
    if(isset($_SESSION['origin']))$origin = $_SESSION['origin'];
    if(isset($_SESSION['rate']))$rate=$_SESSION['rate'];
    if(isset($_SESSION['clientID']))$clientID=$_SESSION['clientID'];//for integration with login page
    if(isset($_SESSION['miles']))$miles=$_SESSION['miles'];
    $ratePerMile=($rate/$miles);
    if(isset($_SESSION['clientName']))$clientName=$_SESSION['clientName'];
    echo $clientName;

    require_once("db.php");

    $sql = "insert into listing
            (       origin,     destination,   dateListed,     weight,    rate,   state,    CDL,    dateFufilled,    clientID,    miles,    ratePerMile,    clientName)
            values ('$origin', '$destination', '$dateListed', '$weight', '$rate','$state', '$CDL', '$dateFufilled', '$clientID', '$miles', '$ratePerMile', '$clientName')";
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from listing where destination='$destination' and
                dateListed='$dateListed' and
                weight='$weight' and
                origin='$origin' and
                rate='$rate' and state='$state' and
                CDL='$CDL' and
                dateFufilled='$dateFufilled'";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>A new Listing is now pending approval:</p></br>";

           echo "<table>
              <tr>
                <th>  Client Name </th>
                <th>  Origin  </th>
                <th>  Destination </th>
                <th>  date listed </th>
                <th>  Weight  </th>
                <th>  rate  </th>
                <th>  Miles </th>
                <th>  Rate per Mile </th>
              </tr>
              <tr>
                <td>".$row['clientName']."</td>
                <td>".$row['origin']."</td>
                <td>".$row['destination']."</td>
                <td>".$row['dateListed']."</td>
                <td>".$row['weight']."</td>
                <td>".$row['rate']."</td>
                <td>".$row['miles']."</td>
                <td>".$row['ratePerMile']."</td>
              </tr>
            </table>";
                   }
         }
         else
         {
           $sql= "delete from listing where destination='$destination' and
                dateListed='$dateListed' and
                weight='$weight' and
                origin='$origin' and
                rate='$rate' and
                state='$state' and
                CDL='$CDL' and
                dateFufilled='$dateFufilled'and
                miles='$miles' and
                ratePerMile='$ratePerMile' and
                clientName='$clientName'";
                $result=$mydb->query($sql);
           echo "an error occured, please try again";
         }
  ?>
  <p style='margin-left: auto; display: block; margin-right: auto;'>
    <a style="background-color:white;" href="logout.php">Click here to log out</a>
  </p>
</body>
</html>
