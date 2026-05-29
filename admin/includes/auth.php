<?php
/**
 * Vision Exim — Authentication Guard
 * Include this at the very top of admin pages to ensure the user is logged in.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure config is loaded so ve_url is available
require_once __DIR__ . '/../../includes/config.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page
    header('Location: ' . ve_url('admin/index.php'));
    exit;
}
