<?php
session_start();

//file_put_contents('debugLog.log', var_export($_SESSION['username'],true));

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "usernames";

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, task FROM tasks WHERE user= 'miti'";
$result = $conn->query($sql);


$result_array = array();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

//            file_put_contents('debugLog.log', var_export($row,true));

        array_push($result_array, $row);
    }
}

file_put_contents('debugLog.log', var_export($result_array,true));

header('Content-type: application/json');
echo json_encode($result_array);

$conn->close();
?>