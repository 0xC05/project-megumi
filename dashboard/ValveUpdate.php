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

if(isset($_GET['id']) && isset($_GET['Status']) )
   {
        $id = $_GET['id'];
        $status = $_GET['Status'];
        if($status==1)
        $sql = "UPDATE valvestate SET LASTOPEN = CONVERT_TZ(CURRENT_TIMESTAMP ,'+00:00','+05:30'), LASTCLOSE = '0000-00-00 00:00:00' WHERE NODEID=$id ";
         else
            $sql = 
        $sql = "UPDATE valvestate SET LASTCLOSE = CONVERT_TZ(CURRENT_TIMESTAMP ,'+00:00','+05:30') WHERE NODEID=$id ";
        if ($conn->query($sql)) {
            echo "Enjoy";
             } else {
            echo "Error creating table: " . $conn->error;
 }
        $conn->close();

}

?>