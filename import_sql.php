<?php
$host = 'localhost';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS `a1676fyx_visionexim_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "Database 'a1676fyx_visionexim_db' created or already exists.<br>\n";
} else {
    echo "Error creating database: " . $conn->error . "<br>\n";
}

$conn->select_db('a1676fyx_visionexim_db');

// Read the SQL file
$sqlFile = 'a1676fyx_visionexim_db (1).sql';
if (!file_exists($sqlFile)) {
    die("SQL file not found. Please ensure it's in the same directory.");
}

$sqlContent = file_get_contents($sqlFile);

// Execute multi query
echo "Importing SQL file...<br>\n";
if ($conn->multi_query($sqlContent)) {
    do {
        // Store first result set
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "<b>SQL file imported successfully.</b><br>\n";
    echo "You can now delete this import script.<br>\n";
} else {
    echo "<b>Error importing SQL file:</b> " . $conn->error;
}

$conn->close();
?>
