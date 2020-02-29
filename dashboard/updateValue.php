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

if(isset($_GET['id']) && isset($_GET['moisture']) && isset($_GET['waterLevel']) && isset($_GET['status']) )
   {
        $id = $_GET['id'];
        $moisture = $_GET['moisture'];
        $waterLevel = $_GET['waterLevel'];
        $status = $_GET['status'];


        $sql = "UPDATE data SET Humidity = '$moisture', waterlevel = '$waterLevel', valvestate = $status WHERE nodeid = $id";
        $result = $conn->query($sql);

        if ($result) {
            echo "Success";
             } else {
            echo "Fail";
        }
        $conn->close();

}

?>