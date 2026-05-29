<?php
/**
 * Vision Exim — Database Connection
 * All admin modules include this file to get a $conn (mysqli) handle.
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';          // Default XAMPP — change for production
$db_name = 'vision_exim';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;padding:40px;text-align:center;">
            <h2 style="color:#B9412E;">Database Connection Failed</h2>
            <p style="color:#666;">' . htmlspecialchars($conn->connect_error) . '</p>
            <p style="color:#999;font-size:13px;">Please check your database configuration settings in <b>admin/includes/db.php</b>.</p>
         </div>');
}

// Set charset
$conn->set_charset('utf8mb4');
