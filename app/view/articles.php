<?php
require_once '../../vendor/autoload.php';
use App\Controllers\ArticleController;
// use App\Models\CategoryModel;
// use App\Models\TagModel;

$articleController = new ArticleController();
// $categoryModel = new CategoryModel();
// $tagModel = new TagModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $articleController->createArticle();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $articleController->edit($_POST['id']);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $articleController->delete($_POST['id']);
    }
}

$articles = $articleController->showAll();
// $categories = $categoryModel->getAllCategories(); // Vous récupérez toutes les catégories
// $tags = $tagModel->getAllTags(); // Vous récupérez tous les tags
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: rgb(78, 115, 223);
            border-color: rgb(78, 115, 223);
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
        <h1 class="text-primary text-center mb-4">Gestion des Articles</h1>

        <!-- Liste des articles -->
        <h2 class="text-secondary mb-3">Liste des Articles</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?= htmlspecialchars($article['id']) ?></td>
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td><?= htmlspecialchars($article['category_name']) ?></td>
                            <td><?= htmlspecialchars($article['tags']) ?></td>
                            <td>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <input type="hidden" name="action" value="edit">
                                    <button type="submit" class="btn btn-info btn-sm">Modifier</button>
                                </form>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun article trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Formulaire d'ajout d'article -->
        <h2 class="text-secondary mt-5">Ajouter / Modifier un Article</h2>
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'Article:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug:</label>
                <input type="text" name="slug" id="slug" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Choisissez une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags:</label>
                <select name="tags[]" id="tags" class="form-control" multiple required>
                    <?php foreach ($tags as $tag): ?>
                        <option value="<?= $tag['id'] ?>"><?= htmlspecialchars($tag['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
