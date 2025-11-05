<?php
include __DIR__ . '/../db.php';
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $category = $conn->real_escape_string($_POST['category']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $image = '';
    if(!empty($_FILES['image']['name'])){
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../files/images/' . $image);
    }
    $icon = '';
    if(!empty($_FILES['icon']['name'])){
        $icon = basename($_FILES['icon']['name']);
        move_uploaded_file($_FILES['icon']['tmp_name'], __DIR__ . '/../files/images/' . $icon);
    }
    $stmt = $conn->prepare('INSERT INTO sections (category,title,description,image,icon) VALUES (?,?,?,?,?)');
    $stmt->bind_param('sssss', $category, $title, $description, $image, $icon);
    $stmt->execute();
    $msg = 'Created!';
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create - WPoets Full Stack Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Wpoets</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="crud/list.php">Posts List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-4">
        <h3>Create Section</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3"><input class="form-control" name="category" placeholder="Category" required></div>
            <div class="mb-3"><input class="form-control" name="title" placeholder="Title" required></div>
            <div class="mb-3"><textarea class="form-control" name="description" placeholder="Description"></textarea>
            </div>
            <div class="mb-3"><input type="file" class="form-control" name="image" accept="image/*"></div>
            <div class="mb-3"><input type="file" class="form-control" name="icon" accept="image/*"></div>
            <button class="btn btn-primary">Save</button>
            <a class="btn btn-secondary" href="list.php">Back</a>
        </form>
        <?php if($msg): ?><div class="alert alert-success mt-3"><?= $msg ?></div><?php endif; ?>
    </div>
</body>

</html>