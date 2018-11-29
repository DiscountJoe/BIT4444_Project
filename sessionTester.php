<?php
$email = "knight@ares.com";
$password = "client";
$passConfirm = "client";
$baseLocation = "New York";
$err = false;
$clientName = "Ares Macrotechnology";
$destination = "Capri";
$dateListed = "2019-05-14 00:00:00";
$rate = "1692";
$weight = "1";
$origin = "Mulhouse";
$miles = "344";
$clientID="3";

session_start();
$_SESSION["clientName"] = $clientName;
$_SESSION["email"] = $email;
$_SESSION["password"] = $password;
$_SESSION["passConfirm"] = $passConfirm;
$_SESSION["baseLocation"] = $baseLocation;
$_SESSION["origin"] = $origin;
$_SESSION["destination"] = $destination;
$_SESSION["dateListed"] = $dateListed;
$_SESSION["rate"] = $rate;
$_SESSION["weight"] = $weight;
$_SESSION["clientID"] = $clientID;
$_SESSION['miles']= $miles;
$_SESSION['clientName']=$clientName;
header("Location: editListing.php");
?>
