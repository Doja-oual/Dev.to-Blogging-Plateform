<?php
namespace App\Controllers;

use App\Models\StatisticsModel;

class DashboardController
{
    public function index()
    {
        // Récupérer les statistiques
        $userCount = StatisticsModel::getEntityCount('users');
        $articleCount = StatisticsModel::getEntityCount('articles');
        $categoryCount = StatisticsModel::getEntityCount('categories');
        $tagCount = StatisticsModel::getEntityCount('tags');

        $topAuthors = StatisticsModel::getTopAuthors();
        $articlesByCategory = StatisticsModel::getArticlesByCategory();
        $popularArticles = StatisticsModel::getPopularArticles();

        // Inclure la vue et transmettre les données
        include __DIR__ . '/../views/dashboard.php';
    }
}
