<?php
include "connection.php";

$sql = isset($_GET['sql']) ? $_GET['sql'] : null;

if (!$sql) {
    die("Usage: db_query.php?sql=YOUR_COMMAND_HERE");
}

$result = pg_query($conn, $sql);

if ($result) {
    echo "<h2 style='color:green;'>Command Successful</h2>";
    $affected = pg_affected_rows($result);
    echo "<p>Rows affected: $affected</p>";
} else {
    echo "<h2 style='color:red;'>SQL Error</h2>";
    echo "<pre>" . pg_last_error($conn) . "</pre>";
}
?>
