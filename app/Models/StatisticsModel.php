
<?php
namespace App\ModelsStatistics;

use App\Config\Database;

class StatisticsModel
{
    // Nombre total d'entités (utilisateurs, articles, catégories, tags)
    public static function getEntityCount($table)
    {
        $db = Database::getConnection();
        $query = "SELECT COUNT(*) AS count FROM $table";
        $stmt = $db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    // Les 3 meilleurs auteurs (basés sur les articles publiés ou lus)
    public static function getTopAuthors()
    {
        $db = Database::getConnection();
        $query = "
            SELECT authors.name, COUNT(articles.id) AS articles_count
            FROM authors
            JOIN articles ON articles.author_id = authors.id
            GROUP BY authors.id
            ORDER BY articles_count DESC
            LIMIT 3
        ";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Nombre d'articles par catégorie
    public static function getArticlesByCategory()
    {
        $db = Database::getConnection();
        $query = "
            SELECT categories.name, COUNT(articles.id) AS articles_count
            FROM categories
            LEFT JOIN articles ON articles.category_id = categories.id
            GROUP BY categories.id
        ";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Articles les plus populaires
    public static function getPopularArticles($limit = 5)
    {
        $db = Database::getConnection();
        $query = "
            SELECT title, views 
            FROM articles 
            ORDER BY views DESC 
            LIMIT $limit
        ";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>