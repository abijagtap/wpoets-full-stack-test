<?php
include __DIR__ . '/../db.php';
$res = $conn->query('SELECT * FROM sections ORDER BY id ASC');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List - WPoets Full Stack Test</title>
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
        <h3>Sections</h3><a class="btn btn-success mb-3" href="create.php">Create New</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($r = $res->fetch_assoc()): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['category']) ?></td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><img src="../files/images/<?= htmlspecialchars($r['image']) ?>" width="50px" height="30px"></td>
                    <td><img src="../files/images/<?= htmlspecialchars($r['icon']) ?>" width="50px" height="30px"></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="update.php?id=<?= $r['id'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $r['id'] ?>"
                            onclick="return confirm('Delete?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>