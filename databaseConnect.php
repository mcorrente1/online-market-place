<?php
$servername = "us-cdbr-sl-dfw-01.cleardb.net";
$username = "b8e24747489532";
$password = "1a2a9e6a";
$dbname = "ibmx_fe83c219896edb4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "Connected successfully <br>";
}

$sql = "SELECT * FROM test_table;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["num"]. " - Name: " . $row["string"].  "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>