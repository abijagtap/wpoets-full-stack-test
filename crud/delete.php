<?php
include __DIR__ . '/../db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    // Fetch existing image/icon before deleting the record
    $res = $conn->query("SELECT image, icon FROM sections WHERE id = $id");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();

        $imgPath = __DIR__ . '/../files/images/' . $row['image'];
        $iconPath = __DIR__ . '/../files/images/' . $row['icon'];

        if (is_file($imgPath)) {
            unlink($imgPath);
        }

        if (is_file($iconPath)) {
            unlink($iconPath);
        }
    }

    $conn->query("DELETE FROM sections WHERE id = $id");
}

header('Location: list.php');
exit;
