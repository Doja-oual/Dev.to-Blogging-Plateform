<?php
namespace App\Controllers;
require_once __DIR__. '/../../vendor/autoload.php';
use App\Models\ArticleModel;

class ArticleController {
    // Récupérer tous les articles
    public function getAllArticles() {
        try {
            return ArticleModel::getAllArticles();
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Ajouter un nouvel article
    public function addArticle($data) {
        try {
            if (empty($data['title']) || empty($data['slug']) || empty($data['content'])) {
                throw new \Exception("Tous les champs requis doivent être remplis");
            }
            
            // Verifier si le slug existe deja
            if (ArticleModel::checkSlugExists($data['slug'])) {
                throw new \Exception("Le slug est déjà utilisé. Veuillez en choisir un autre.");
            }
            
            // Appeler le modele pour ajouter l'article
            return ArticleModel::addArticle($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // Mettre à jour un article
    public function updateArticle($id, $data) {
        try {
            if (empty($id)) {
                throw new \Exception("ID article requis");
            }
            return ArticleModel::updateArticle($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // Supprimer un article
    public function deleteArticle($id) {
        try {
            if (empty($id)) {
                throw new \Exception("ID article requis");
            }
            return ArticleModel::deleteArticle($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // show un article par ID
    public function getArticleById($id) {
        try {
            return ArticleModel::getArticleById($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}

