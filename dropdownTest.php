<?php

require_once("db.php");
$sql="select origin from listing";
$result = $mydb->query($sql);
echo "<select id='Dropdown'>";
//grabs next row in table and converts it into array
while($row=mysqli_fetch_array($result)){
  $Selection=$row["origin"];
  echo "<option value = '$Selection'>$selection</option>";
}
echo "</select>";
?>
