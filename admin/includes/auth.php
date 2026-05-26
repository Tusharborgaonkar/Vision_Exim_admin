<?php
/**
 * Vision Exim — Authentication Guard
 * Include this at the very top of admin pages to ensure the user is logged in.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page
    header('Location: /vision_exim/admin/index.php');
    exit;
}
