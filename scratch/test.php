<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}
echo "Connected successfully to MySQL.\n";
$res = $conn->query("SHOW DATABASES");
while ($row = $res->fetch_row()) {
    echo "- Database: " . $row[0] . "\n";
}

$conn->select_db('vision_exim');
$res = $conn->query("SHOW TABLES");
if ($res) {
    echo "Tables in vision_exim:\n";
    while ($row = $res->fetch_row()) {
        echo "  - " . $row[0] . "\n";
    }
} else {
    echo "vision_exim database does not exist or has no tables.\n";
}
