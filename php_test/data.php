<?php
$servername = "localhost";
$username = "root";
$password = "M0nt4n4!!";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";


$playerInfo = []; // declare an array

//$sql = "SELECT * FROM mygame.playerinfo;";
$sql = "CALL mygame.spGetPlayerInfo;";
$result = $conn->query($sql);

// create a table
$final_output = "<table border=1>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   
    // add each item to a row in the table
    $final_output .= "<tr><td>id: " . $row["playerid"]. "</td><td> name: " . $row["playername"]. "</td></tr>";
    // add each row to the array
    $playerInfo += [$row["playerid"] => $row["playername"]];
  }
} else {
  echo "0 results";
}

// close the table
$final_output .= "</table>";

// print out the final table
echo $final_output;
$conn->close();

// print out the JSON object based on the array
echo json_encode($playerInfo);

?>

