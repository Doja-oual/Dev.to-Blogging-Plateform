le code la <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSphere - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Style personnalisé pour correspondre au design du dashboard */
        .bg-light {
            background-color: rgb(244, 246, 249) !important;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            margin-left: 250px; /* Pour laisser de la place à la sidebar */
            padding: 20px;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: rgb(78, 115, 223) !important;
        }
        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-card h3 {
            font-size: 18px;
            color: #333;
        }
        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .footer {
            background-color: white;
            border-top: 1px solid #e0e0e0;
            padding: 20px 0;
            margin-top: 40px;
        }
        .footer a {
            color: rgb(78, 115, 223);
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="p-3">
            <h3 class="text-primary mb-4">DevSphere</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/">
                        <i class="bi bi-house me-2"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/articles">
                        <i class="bi bi-file-earmark-text me-2"></i>Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">
                        <i class="bi bi-tags me-2"></i>Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tags">
                        <i class="bi bi-hash me-2"></i>Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">
                        <i class="bi bi-info-circle me-2"></i>À Propos
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white shadow-sm mb-4">
            <div class="container-fluid">
                <nav class="navbar navbar-light">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-3 d-lg-none" id="sidebarToggle">
                            <i class="bi bi-list"></i>
                        </button>
                        <h1 class="h4 mb-0">Dashboard</h1>
                    </div>
                    <div class="d-flex">
                        <form class="d-flex me-3" action="/search" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                        <a href="/logout" class="btn btn-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                        </a>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Contenu Principal -->
        <div class="container-fluid">
            <!-- Statistiques Globales -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3>Utilisateurs Inscrits</h3>
                        <p>1,234</p>
                        <span class="text-success">+5% ce mois-ci</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3>Articles Publiés</h3>
                        <p>567</p>
                        <span class="text-success">+12% ce mois-ci</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3>Catégories Actives</h3>
                        <p>45</p>
                        <span class="text-success">+3% ce mois-ci</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3>Tags Utilisés</h3>
                        <p>789</p>
                        <span class="text-success">+8% ce mois-ci</span>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-secondary">Activité des Articles (30 derniers jours)</h3>
                            <canvas id="articleActivityChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-secondary">Répartition des Catégories</h3>
                            <canvas id="categoryDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h3 class="text-primary">DevSphere</h3>
                    <p class="text-muted">La plateforme collaborative pour développeurs et passionnés de technologie.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="text-secondary">Liens Utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="/about">À Propos</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/privacy-policy">Politique de Confidentialité</a></li>
                        <li><a href="/terms-of-service">Conditions d'Utilisation</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-secondary">Réseaux Sociaux</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://twitter.com/devsphere">Twitter</a></li>
                        <li><a href="https://github.com/devsphere">GitHub</a></li>
                        <li><a href="https://linkedin.com/company/devsphere">LinkedIn</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-secondary">Newsletter</h5>
                    <form action="/newsletter" method="POST">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Votre email" required>
                            <button type="submit" class="btn btn-primary">S'abonner</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-muted">&copy; 2023 DevSphere. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS et Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique d'activité des articles
        const articleActivityCtx = document.getElementById('articleActivityChart').getContext('2d');
        new Chart(articleActivityCtx, {
            type: 'line',
            data: {
                labels: ['1 Oct', '2 Oct', '3 Oct', '4 Oct', '5 Oct', '6 Oct', '7 Oct'],
                datasets: [{
                    label: 'Articles Publiés',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderColor: 'rgb(78, 115, 223)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique de répartition des catégories
        const categoryDistributionCtx = document.getElementById('categoryDistributionChart').getContext('2d');
        new Chart(categoryDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Web Dev', 'AI', 'DevOps', 'Programming'],
                datasets: [{
                    label: 'Articles par Catégorie',
                    data: [12, 19, 3, 5],
                    backgroundColor: [
                        'rgb(78, 115, 223)',
                        'rgb(28, 200, 138)',
                        'rgb(246, 194, 62)',
                        'rgb(231, 74, 59)'
                    ]
                }]
            }
        });

        // Toggle Sidebar en mode mobile
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('d-none');
        });
    </script>
</body>
</html>