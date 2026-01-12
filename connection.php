<?php
// Render provides these via Environment Variables
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = "5432"; // Postgres port

$conn_string = "host=$host port=$port dbname=$db user=$user password=$pass sslmode=require";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Database Connection Failed.");
}
?>
