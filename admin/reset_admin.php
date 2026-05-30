<?php
// reset_admin.php
// Temporarily upload this to your production 'admin' folder to reset the password

require_once 'includes/db.php';

$new_password = 'admin123';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE admin_users SET password = ?");
if ($stmt->execute()) {
    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h3>Success!</h3>";
    echo "<p>Password successfully reset for all admin users.</p>";
    echo "<p>Your new password is: <strong>" . htmlspecialchars($new_password) . "</strong></p>";
    echo "<a href='index.php' style='display: inline-block; padding: 10px 20px; background: #1F4D3A; color: #fff; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
    echo "</div>";
} else {
    echo "Failed to reset password: " . $conn->error;
}
$stmt->close();
?>
