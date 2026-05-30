<?php
/**
 * Vision Exim — Database Connection
 * All admin modules include this file to get a $conn (mysqli) handle.
 */

// Require the central config file which holds the database credentials
require_once __DIR__ . '/../../includes/config.php';

// Enable exception handling for mysqli (default in PHP 8.1+)
mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

try {
    // Create connection
    $conn = new mysqli(VE_DB_HOST, VE_DB_USER, VE_DB_PASS, VE_DB_NAME);
} catch (Exception $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    die('<div style="font-family:sans-serif;padding:40px;text-align:center;">
            <h2 style="color:#B9412E;">Database Connection Failed</h2>
            <p style="color:#666;">A database error occurred. Please try again later or contact support.</p>
         </div>');
}

// Set charset
$conn->set_charset('utf8mb4');
