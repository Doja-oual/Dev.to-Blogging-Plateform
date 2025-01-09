<?php
require_once '../../../vendor/autoload.php';
use App\Controllers\ArticleController;
use App\Controllers\CategorieController;
use App\Controllers\TagController;

$categoryController = new CategorieController();
$categories = $categoryController->getCategory();

$tagController = new TagController();
$tags = $tagController->getTag();

$articleController = new ArticleController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $data = [
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id'],
                'author_id' => $_POST['author_id'],
                'tags' => $_POST['tags'] ?? [] 
            ];
            try {
                $articleController->addArticle($data);
                header('Location: /articles');
                exit();
            } catch (\Exception $e) {
                echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
            }
        } elseif ($_POST['action'] === 'delete') {
            try {
                $articleController->deleteArticle($_POST['id']);
                header('Location: /articles');
                exit();
            } catch (\Exception $e) {
                echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
            }
        }
    }
}

$articles = $articleController->getAllArticles();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Gestion des Articles</h1>

        <!-- Formulaire pour ajouter un article -->
        <h2 class="text-secondary mb-3">Ajouter un Article</h2>
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug :</label>
                <input type="text" name="slug" id="slug" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu :</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie :</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags :</label>
                <select name="tags[]" id="tags" class="form-control" multiple required>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= htmlspecialchars($tag['id']) ?>"><?= htmlspecialchars($tag['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Auteur :</label>
                <input type="number" name="author_id" id="author_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <!-- Liste des articles -->
        <h2 class="text-secondary mt-5">Liste des Articles</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Slug</th>
                    <th>Contenu</th>
                    <th>Catégorie</th>
                    <th>Tags</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)) : ?>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td><?= htmlspecialchars($article['id']) ?></td>
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td><?= htmlspecialchars($article['slug']) ?></td>
                            <td><?= htmlspecialchars($article['content']) ?></td>
                            <td><?= htmlspecialchars($article['category_name']) ?></td>
                            <td><?= htmlspecialchars($article['tags']) ?></td>
                            <td><?= htmlspecialchars($article['author_id']) ?></td>
                            <td>
                                <a href="edit.php?edit=<?= $article['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun article trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>