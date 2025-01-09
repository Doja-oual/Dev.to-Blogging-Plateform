<?php
require_once '../../../vendor/autoload.php';
use App\Controllers\ArticleController;
use App\Controllers\CategorieController;
use App\Controllers\TagController;

$articleId = $_GET['edit'] ?? null;
if (!$articleId) {
    header('Location: articles.php');
    exit();
}

$articleController = new ArticleController();
$categoryController = new CategorieController();
$tagController = new TagController();

$article = $articleController->getArticleById($articleId);
if (!$article) {
    header('Location: articles');
    exit();
}

$categories = $categoryController->getCategory();
$tags = $tagController->getTag();

$articleTags = $articleController->getTagsForArticle($articleId);
$articleTagIds = array_column($articleTags, 'id'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'author_id' => $_POST['author_id'],
        'tags' => $_POST['tags'] ?? []
    ];

    try {
        $articleController->updateArticle($articleId, $data);
        header('Location: articles.php');
        exit();
    } catch (\Exception $e) {
        echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Modifier l'article</h1>

        <!-- Formulaire de modification -->
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($article['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug :</label>
                <input type="text" name="slug" id="slug" class="form-control" value="<?= htmlspecialchars($article['slug']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu :</label>
                <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($article['content']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie :</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] == $article['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags :</label>
                <select name="tags[]" id="tags" class="form-control" multiple required>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= htmlspecialchars($tag['id']) ?>" <?= in_array($tag['id'], $articleTagIds) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tag['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Auteur :</label>
                <input type="number" name="author_id" id="author_id" class="form-control" value="<?= htmlspecialchars($article['author_id']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="/articles" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>