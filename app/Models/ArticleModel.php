<?php
namespace App\Models;

use Config\Database;

class ArticleModel {
    private static function getConnection() {
        return Database::getConnection();
    }

    // Vérifie si un slug existe déjà
    public static function checkSlugExists($slug) {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) FROM articles WHERE slug = :slug";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetchColumn() > 0;
    }

    
    // Ajouter un article
    public static function addArticle($data) {
        $conn = self::getConnection();
        $sql = "INSERT INTO articles (title, slug, content, category_id, author_id) 
                VALUES (:title, :slug, :content, :category_id, :author_id)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id']
        ]);
        return $conn->lastInsertId(); // Retourne l'ID de l'article ajouté
    }

    // Récupérer tous les articles avec catégorie et tags
    public static function getAllArticles() {
        $conn = self::getConnection();
        $sql = "
            SELECT 
                articles.*, 
                categories.name AS category_name,
                GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags
            FROM 
                articles
            LEFT JOIN 
                categories ON articles.category_id = categories.id
            LEFT JOIN 
                article_tags ON articles.id = article_tags.article_id
            LEFT JOIN 
                tags ON article_tags.tag_id = tags.id
            GROUP BY 
                articles.id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupérer un article par ID
    public static function getArticleById($id) {
        $conn = self::getConnection();
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Mettre à jour un article
    public static function updateArticle($id, $data) {
        $conn = self::getConnection();
        $sql = "UPDATE articles SET 
                title = :title, 
                slug = :slug, 
                content = :content, 
                category_id = :category_id 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'id' => $id
        ]);
    }

    // Supprimer un article
    public static function deleteArticle($id) {
        $conn = self::getConnection();
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Ajouter des tags à un article
    public static function addTagsToArticle($articleId, $tagIds) {
        $conn = self::getConnection();
        $sql = "INSERT INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)";
        $stmt = $conn->prepare($sql);
        foreach ($tagIds as $tagId) {
            $stmt->execute(['article_id' => $articleId, 'tag_id' => $tagId]);
        }
    }

    // Récupérer les tags d'un article
    public static function getTagsForArticle($articleId) {
        $conn = self::getConnection();
        $sql = "SELECT tags.id, tags.name 
                FROM tags 
                JOIN article_tags ON tags.id = article_tags.tag_id 
                WHERE article_tags.article_id = :article_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['article_id' => $articleId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}