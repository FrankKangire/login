<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "user_auth";

$conn = new mysqli($servername, $username, $password, $db_name);

if($conn->connect_error){
    die("Connection lost".$conn->connect_error);
}
?>