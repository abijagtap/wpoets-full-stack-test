<?php
include __DIR__ . '/../db.php';
$msg = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) die('No id');

$res = $conn->query("SELECT * FROM sections WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $conn->real_escape_string($_POST['category']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);

    $image = $row['image'];
    $icon = $row['icon'];

    $imageDir = __DIR__ . '/../files/images/';

    // image upload
    if (!empty($_FILES['image']['name'])) {
        $newImage = basename($_FILES['image']['name']);
        $targetImage = $imageDir . $newImage;

        // Delete old image
        if (!empty($image) && file_exists($imageDir . $image)) {
            unlink($imageDir . $image);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $targetImage);
        $image = $newImage;
    }

    // icon upload
    if (!empty($_FILES['icon']['name'])) {
        $newIcon = basename($_FILES['icon']['name']);
        $targetIcon = $imageDir . $newIcon;

        // Delete old icon
        if (!empty($icon) && file_exists($imageDir . $icon)) {
            unlink($imageDir . $icon);
        }

        move_uploaded_file($_FILES['icon']['tmp_name'], $targetIcon);
        $icon = $newIcon;
    }

    $stmt = $conn->prepare("UPDATE sections SET category=?, title=?, description=?, image=?, icon=? WHERE id=?");
    $stmt->bind_param('sssssi', $category, $title, $description, $image, $icon, $id);
    $stmt->execute();

    $msg = 'Updated successfully';

    $res = $conn->query("SELECT * FROM sections WHERE id = $id");
    $row = $res->fetch_assoc();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update - WPoets Full Stack Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Wpoets</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="crud/list.php">Posts List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container p-4">
    <h3>Edit Section</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3"><input class="form-control" name="category" value="<?= htmlspecialchars($row['category']) ?>" required></div>
        <div class="mb-3"><input class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>" required></div>
        <div class="mb-3"><textarea class="form-control" name="description"><?= htmlspecialchars($row['description']) ?></textarea></div>
        <div class="mb-3">Current image: <?= htmlspecialchars($row['image']) ?></div>
        <div class="mb-3"><input type="file" class="form-control" name="image" accept="image/*"></div>
        <div class="mb-3">Current icon: <?= htmlspecialchars($row['icon']) ?></div>
        <div class="mb-3"><input type="file" class="form-control" name="icon" accept="image/*"></div>
        <button class="btn btn-primary">Update</button>
        <a class="btn btn-secondary" href="list.php">Back</a>
    </form>
    <?php if ($msg): ?><div class="alert alert-success mt-3"><?= $msg ?></div><?php endif; ?>
</div>
</body>
</html>
