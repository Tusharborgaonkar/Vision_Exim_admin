<?php
/**
 * Vision Exim — Delete Category Action
 */
include '../../includes/auth.php';
include '../../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid category ID.']);
        exit;
    }

    // Check if any products belong to this category
    $check_products = $conn->prepare("SELECT COUNT(*) as cnt FROM products WHERE category_id = ?");
    $check_products->bind_param('i', $id);
    $check_products->execute();
    $res = $check_products->get_result()->fetch_assoc();
    if ((int)$res['cnt'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot delete category. There are ' . $res['cnt'] . ' product(s) assigned to this category.'
        ]);
        $check_products->close();
        exit;
    }
    $check_products->close();

    // Perform deletion
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
