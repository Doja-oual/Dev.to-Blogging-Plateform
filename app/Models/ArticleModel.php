<?php
namespace App\Models;

use Config\Database;

class ArticleModel {
    private static function getConnection() {
        return Database::getConnection();
    }

    // Verifie si un slug existe déjà
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
        return $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id']
        ]);
    }

    // show tous les articles
    public static function getAllArticles() {
        $conn = self::getConnection();
        $sql = "SELECT * FROM articles";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // show un article par ID
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
}
