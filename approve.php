<!doctype html>
<html>
<head>
  <title>Success</title>
</head>
<body>
  <?php
    $state = "L";//cancelled
    $CDL = "N/A";//not applicable
    $dateFufilled = "N/A";//not applicable

    session_start();
  /*  $destination = $_SESSION["destination"];
    $dateListed = $_SESSION["dateListed"];
    $weight = $_SESSION["weight"];
    $origin = $_SESSION["origin"];
    $rate=$_SESSION["rate"];
    $clientID=$_SESSION['clientID'];//for integration with login page
    $miles=$_SESSION['miles'];
    $ratePerMile=($rate/$miles); */
    $listingID=$_SESSION['listingID'];
    if (isset($_SESSION['adminID']))
    {
      echo "<a href='moderationNew.php'>Back to Moderation</a>";
    }

    //$clientName=$_SESSION['clientName']; for integration with login page
    $clientName="Pedros inconspicuous shipping crates"; //placeholder until login integration

    require_once("db.php");

    $sql = "update listing set state = '$state' where listingID=$listingID";

    /*"insert into listing
            (       origin,     destination,   dateListed,     weight,    rate,   state,    CDL,    dateFufilled,    clientID,    miles,    ratePerMile,    clientName)
            values ('$origin', '$destination', '$dateListed', '$weight', '$rate','$state', '$CDL', '$dateFufilled', '$clientID', '$miles', '$ratePerMile', '$clientName')";
            */
         $result=$mydb->query($sql);

         if ($result==1) {

           $sql2 = "select * from listing where listingID=$listingID";
                $result=$mydb->query($sql2);
                while($row = mysqli_fetch_array($result)){
           echo "<p>An edited Listing is now approved! And that's tea, sis!:</p></br>";

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
           echo "an error occured, please try again and ensure that the data is valid.";
         }
  ?>

</body>
</html>
