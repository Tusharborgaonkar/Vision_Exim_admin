<?php
/**
 * submit-inquiry.php
 * Handles AJAX POST from the public contact form.
 * Saves the inquiry to the `inquiries` table.
 * Returns JSON: { success: bool, message: string }
 */
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request.';
    echo json_encode($response);
    exit;
}

// Collect & sanitise input
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$company = trim($_POST['company'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    $response['message'] = 'Name, email, and message are required.';
    echo json_encode($response);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'Please enter a valid email address.';
    echo json_encode($response);
    exit;
}

// Connect to DB
require_once 'admin/includes/db.php';

$stmt = $conn->prepare(
    "INSERT INTO inquiries (company_name, contact_name, email, phone, requested_product, message, source, status, created_at)
     VALUES (?, ?, ?, ?, ?, ?, 'website', 'new', NOW())"
);

if (!$stmt) {
    $response['message'] = 'Server error. Please try again later.';
    echo json_encode($response);
    exit;
}

$stmt->bind_param('ssssss', $company, $name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Thank you! Your inquiry has been received. We will get back to you shortly.';
} else {
    $response['message'] = 'Failed to submit. Please try again.';
}

$stmt->close();
echo json_encode($response);
