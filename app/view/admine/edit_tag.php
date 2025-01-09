<?php
require_once '../../../vendor/autoload.php';
use App\Controllers\TagController;

// Récupérer l'ID du tag à modifier depuis l'URL
$tagId = $_GET['edit'] ?? null;
if (!$tagId) {
    header('Location: /tags.pch');
    exit();
}

// Instancier le contrôleur
$tagController = new TagController();

// Récupérer les données du tag à modifier
$tag = $tagController->getTag($tagId);
if (!$tag) {
    header('Location: /tags.pch');
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $data = [
            'name' => $_POST['name']
        ];

        try {
            $tagController->modifieTag($tagId, $data);
            header('Location: /tags.pch');
            exit();
        } catch (\Exception $e) {
            echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Tag</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: rgb(78, 115, 223);
            border-color: rgb(78, 115, 223);
        }
        .btn-secondary {
            background-color: rgb(108, 117, 125);
            border-color: rgb(108, 117, 125);
        }
        .bg-light {
            background-color: rgb(244, 246, 249) !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Modifier le Tag</h1>

        <!-- Formulaire de modification -->
        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Nom du Tag :</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($tag['name']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="/tags.pch" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>