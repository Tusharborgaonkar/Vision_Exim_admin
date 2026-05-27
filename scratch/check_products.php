<?php
require 'admin/includes/db.php';
$res = $conn->query('SELECT id, name, image, gallery_images FROM products');
while($r = $res->fetch_assoc()) {
    echo "ID: " . $r['id'] . " | Name: " . $r['name'] . " | Image: " . $r['image'] . " | Gallery: " . $r['gallery_images'] . "\n";
}
