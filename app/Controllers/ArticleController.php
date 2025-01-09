<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
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
    public function getTagsForArticle($articleId) {
        try {
            $articleModel = new ArticleModel();
            return $articleModel->getTagsForArticle($articleId);
        } catch (\Exception $e) {
            return [];
        }
    }

    // Ajouter un nouvel article
    public function addArticle($data) {
        try {
            if (empty($data['title']) || empty($data['slug']) || empty($data['content'])) {
                throw new \Exception("Tous les champs requis doivent être remplis");
            }

            // Vérifier si le slug existe déjà
            if (ArticleModel::checkSlugExists($data['slug'])) {
                throw new \Exception("Le slug est déjà utilisé. Veuillez en choisir un autre.");
            }

            // Ajouter l'article
            $articleId = ArticleModel::addArticle($data);

            // Ajouter les tags associés
            if (!empty($data['tags'])) {
                ArticleModel::addTagsToArticle($articleId, $data['tags']);
            }

            return true;
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

            // Mettre à jour l'article
            ArticleModel::updateArticle($id, $data);

            // Mettre à jour les tags associés
            if (!empty($data['tags'])) {
                ArticleModel::addTagsToArticle($id, $data['tags']);
            }

            return true;
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

    // Récupérer un article par ID
    public function getArticleById($id) {
        try {
            return ArticleModel::getArticleById($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}