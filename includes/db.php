<?php
$host = '127.0.0.1';
$db   = 'dbstudents';
$user = 'Sirverio_Database';
$pass = 'sirverio08';
$port = 5500; // port as integer

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>