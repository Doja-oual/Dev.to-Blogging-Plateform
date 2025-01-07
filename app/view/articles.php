<?php
// Inclure le contrôleur pour obtenir les articles
require_once '../../vendor/autoload.php';
use App\Controllers\ArticleController;

$articleController = new ArticleController();

// Obtenez tous les articles
$articles = $articleController->getAllArticles();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <td>
                                <!-- Formulaire de modification -->
                                <form action="edit_article.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button type="submit" class="btn btn-info btn-sm">Modifier</button>
                                </form>
                                
                                <!-- Formulaire de suppression -->
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucun article trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Formulaire d'ajout d'article -->
        <h2 class="text-secondary mt-5">Ajouter un Nouvel Article</h2>
        <form action="create_article.php" method="POST" class="bg-white p-4 shadow-sm rounded">
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
                    <!-- Ajoutez les catégories ici -->
                    <option value="1">Catégorie 1</option>
                    <option value="2">Catégorie 2</option>
                </select>
            </div>
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn btn-primary">Ajouter l'Article</button>
        </form>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
