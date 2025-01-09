<?php
require_once '../../../vendor/autoload.php';
use App\Controllers\CategorieController;
$categoryController = new CategorieController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $categoryController->addCategory();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $categoryController->modifieCategory($_POST['id']);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $categoryController->supprimeCategory($_POST['id']);
    }
}

$categories = $categoryController->getCategory();

$articleCountByCategory = $categoryController->getArticleCountByCategory();

$mostPopularCategories = $categoryController->getMostPopularCategories();

$categoryTrends = $categoryController->getCategoryTrends();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary { background-color: rgb(78, 115, 223); border-color: rgb(78, 115, 223); }
        .btn-success { background-color: rgb(28, 200, 138); border-color: rgb(28, 200, 138); }
        .btn-info { background-color: rgb(54, 185, 204); border-color: rgb(54, 185, 204); }
        .btn-warning { background-color: rgb(246, 194, 62); border-color: rgb(246, 194, 62); }
        .btn-danger { background-color: rgb(231, 74, 59); border-color: rgb(231, 74, 59); }
        .bg-light { background-color: rgb(244, 246, 249) !important; }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
            border-radius: 15px 15px 0 0;
            padding: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body ul {
            list-style-type: none;
            padding: 0;
        }

        .card-body ul li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            font-size: 1rem;
            color: #333;
            display: flex;
            align-items: center;
        }

        .card-body ul li:last-child {
            border-bottom: none;
        }

        .card-body ul li i {
            margin-right: 10px;
            color: #2575fc;
        }

        .row {
            margin-top: 2rem;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            color: #2575fc;
            font-weight: bold;
        }
    
    </style>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Gestion des Catégories</h1>

        <!-- Affichage des statistiques -->
        <h2 class="text-secondary mb-3">Statistiques des Catégories</h2>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Nombre d'articles par catégorie</div>
                    <div class="card-body">
                        <ul>
                            <?php foreach ($articleCountByCategory as $category): ?>
                                <li><?= htmlspecialchars($category['name']) ?>: <?= $category['item_count'] ?> articles</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Catégories les plus populaires</div>
                    <div class="card-body">
                        <ul>
                            <?php foreach ($mostPopularCategories as $category): ?>
                                <li><?= htmlspecialchars($category['name']) ?>: <?= $category['total_count'] ?> vues</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Tendances des catégories (30 derniers jours)</div>
                    <div class="card-body">
                        <ul>
                            <?php foreach ($categoryTrends as $trend): ?>
                                <li><?= htmlspecialchars($trend['name']) ?>: <?= $trend['item_count'] ?> articles le <?= $trend['creation_date'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Affichage des catégories -->
        <h2 class="text-secondary mb-3">Liste des Catégories</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['id']) ?></td>
                            <td><?= htmlspecialchars($category['name']) ?></td>
                            <td>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                    <input type="hidden" name="action" value="edit">
                                    <button type="submit" class="btn btn-info btn-sm">Modifier</button>
                                </form>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucune catégorie trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Formulaire pour ajouter/modifier une catégorie -->
        <h2 class="text-secondary mt-5">Ajouter / Modifier une Catégorie</h2>
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la Catégorie :</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>