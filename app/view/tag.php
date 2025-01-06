<?php
// require_once  "../Controllers/TagController.php";
require_once '../../vendor/autoload.php';
  use App\Controllers\TagController;

   $tags= new TagController();
   $tags->getTag();
//    TagController::addTag();
//    $SupTags=TagController::supprimeTag();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: rgb(78, 115, 223);
            border-color: rgb(78, 115, 223);
        }
        .btn-success {
            background-color: rgb(28, 200, 138);
            border-color: rgb(28, 200, 138);
        }
        .btn-info {
            background-color: rgb(54, 185, 204);
            border-color: rgb(54, 185, 204);
        }
        .btn-warning {
            background-color: rgb(246, 194, 62);
            border-color: rgb(246, 194, 62);
        }
        .btn-danger {
            background-color: rgb(231, 74, 59);
            border-color: rgb(231, 74, 59);
        }
        .bg-light {
            background-color: rgb(244, 246, 249) !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Tags Management</h1>

        <h2 class="text-secondary mb-3">Tags List</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tags as $tag): ?>
                    <tr>
                        <td><?= htmlspecialchars($tag['id']) ?></td>
                        <td><?= htmlspecialchars($tag['name']) ?></td>
                        <td>
                            <a href="?action=edit&id=<?= $tag['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="?action=delete&id=<?= $tag['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="text-secondary mt-5">Add / Edit Tag</h2>
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Tag Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
