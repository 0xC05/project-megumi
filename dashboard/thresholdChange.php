<?php
$servername = "localhost";
$username = "guardian";
$password = "ripSn00p7";
$dbname = "megumi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
     $sql = "select count(*) from changes ";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['count(*)'];
    }
} else {
    echo "0 results";
}

?>