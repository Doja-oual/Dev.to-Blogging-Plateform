<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'Articles - DevSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .hero-section {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.25rem;
            margin-top: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            border-radius: 10px 10px 0 0;
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            color: #666;
        }
        .btn-primary {
            background-color: #2575fc;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #1a5bbf;
        }
        .sidebar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        .footer a {
            color: #2575fc;
            text-decoration: none;
        }
        .footer a:hover {
            color: #1a5bbf;
        }
    </style>
</head>
<body>
    <!-- Barre de Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">DevSphere</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un article..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <div class="hero-section">
        <div class="container">
            <h1>Bienvenue sur DevSphere</h1>
            <p>Découvrez des articles passionnants sur le développement, la technologie et bien plus encore.</p>
        </div>
    </div>

    <!-- Contenu Principal -->
    <div class="container my-5">
        <div class="row">
            <!-- Liste des Articles -->
            <div class="col-md-8">
                <h2 class="mb-4">Derniers Articles</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Image de l'article">
                            <div class="card-body">
                                <h5 class="card-title">Titre de l'article 1</h5>
                                <p class="card-text">Un aperçu du contenu de l'article. Ce texte est un extrait pour donner une idée de ce que contient l'article.</p>
                                <p class="text-muted">Auteur : John Doe</p>
                                <a href="#" class="btn btn-primary">Lire la suite</a>
                            </div>
                            <div class="card-footer text-muted">
                                Publié le 01/01/2023
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Image de l'article">
                            <div class="card-body">
                                <h5 class="card-title">Titre de l'article 2</h5>
                                <p class="card-text">Un aperçu du contenu de l'article. Ce texte est un extrait pour donner une idée de ce que contient l'article.</p>
                                <p class="text-muted">Auteur : Jane Smith</p>
                                <a href="#" class="btn btn-primary">Lire la suite</a>
                            </div>
                            <div class="card-footer text-muted">
                                Publié le 02/01/2023
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="sidebar">
                    <h4>Catégories Populaires</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#">Développement Web</a></li>
                        <li class="list-group-item"><a href="#">Data Science</a></li>
                        <li class="list-group-item"><a href="#">Mobile</a></li>
                        <li class="list-group-item"><a href="#">DevOps</a></li>
                    </ul>
                    <h4 class="mt-4">Tags Populaires</h4>
                    <div class="d-flex flex-wrap">
                        <a href="#" class="btn btn-outline-secondary btn-sm m-1">PHP</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm m-1">JavaScript</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm m-1">Python</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm m-1">React</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-2">© 2023 DevSphere. Tous droits réservés.</p>
            <p class="mb-0">
                <a href="#">Mentions légales</a> | 
                <a href="#">Politique de confidentialité</a> | 
                <a href="#">Contact</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>