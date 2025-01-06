
<?php
//  require_once __DIR__."../../app/Controllers/ArticleController.php";
//  require_once __DIR__."../app/Controllers/CategorieControll.php";


 use App\ArticleControllers\ArticleController;
 use App\CategoryControllers\CategorieController;



  $articles=ArticleController::showAll();
  ArticleController::creatArticle();
  $categories=CategorieController::getCtegory();


$colors = [
    'rgb(78, 115, 223)',    // primary
    'rgb(28, 200, 138)',    // success
    'rgb(54, 185, 204)',    // info
    'rgb(246, 194, 62)',    // warning
    'rgb(231, 74, 59)',     // danger
    'rgb(133, 135, 150)',   // secondary
    'rgb(90, 92, 105)',     // dark
    'rgb(244, 246, 249)'    // light
];


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Gestion des Articles</h1>

        <!-- Formulaire pour Ajouter / Modifier un article -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <?= isset($article) ? "Modifier l'Article" : "Ajouter un Article" ?>
            </div>
            <div class="card-body">
                <form action="<?= isset($article) ? '/articles/update/' . $article['id'] : '/articles/store' ?>" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?= isset($article) ? htmlspecialchars($article['title']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" 
                               value="<?= isset($article) ? htmlspecialchars($article['slug']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required><?= isset($article) ? htmlspecialchars($article['content']) : '' ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">-- Choisir une catégorie --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= isset($article) && $article['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="author_id" class="form-label">Auteur</label>
                        <select class="form-select" id="author_id" name="author_id" required>
                            <option value="">-- Choisir un auteur --</option>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['id'] ?>" <?= isset($article) && $article['author_id'] == $author['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($author['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success"><?= isset($article) ? "Modifier" : "Ajouter" ?></button>
                </form>
            </div>
        </div>

        <!-- Liste des articles -->
        <div class="card">
            <div class="card-header bg-secondary text-white">Liste des Articles</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Slug</th>
                            <th>Catégorie</th>
                            <th>Auteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($articles)): ?>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?= $article['id'] ?></td>
                                    <td><?= htmlspecialchars($article['title']) ?></td>
                                    <td><?= htmlspecialchars($article['slug']) ?></td>
                                    <td><?= htmlspecialchars($article['category_name']) ?></td>
                                    <td><?= htmlspecialchars($article['author_name']) ?></td>
                                    <td>
                                        <a href="/articles/edit/<?= $article['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                                        <a href="/articles/delete/<?= $article['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Aucun article trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
