<?php
namespace App\Controllers;

use App\Models\StatisticsModel;

class StatisticsController
{
    public function index()
    {
        $totalUsers = StatisticsModel::getEntityCount('users');
        $totalArticles = StatisticsModel::getEntityCount('articles');
        $totalCategories = StatisticsModel::getEntityCount('categories');
        $totalTags = StatisticsModel::getEntityCount('tags');

        $topAuthors = StatisticsModel::getTopAuthors();
        $articlesByCategory = StatisticsModel::getArticlesByCategory();
        $popularArticles = StatisticsModel::getPopularArticles();

        $data = [
            'totalUsers' => $totalUsers,
            'totalArticles' => $totalArticles,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
            'topAuthors' => $topAuthors,
            'articlesByCategory' => $articlesByCategory,
            'popularArticles' => $popularArticles,
        ];

        $this->loadView('admin/statistics', $data);
    }

    private function loadView($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../../views/$view.php";
    }
}