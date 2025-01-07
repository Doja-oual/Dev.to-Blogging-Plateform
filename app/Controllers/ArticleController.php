<?php
namespace App\Controllers;

require_once '../../vendor/autoload.php';
// require_once __DIR__ . '/../models/ArticleModel.php';
use App\ModelArticle\ArticleModel;

class ArticleController {
    // Affiche tous les articles
    public function showAll() {
        $articles = ArticleModel::getAllArticle();
        include '../app/view/articleList.php';
    }

    // Ajoute un article
    public function createArticle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id'],
                'author_id' => $_POST['author_id']
            ];
            ArticleModel::addArticle($data);
            header('Location: /articles');
        } else {
            include '../app/views/articleForm.php';
        }
    }

    // Modifie un article
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id']
            ];
            ArticleModel::updateArticle($id, $data);
            header('Location: /articles');
        } else {
            $article = ArticleModel::getArticleById($id);
            include '../app/views/articleForm.php';
        }
    }

    // Supprime un article
    public function delete($id) {
        ArticleModel::deleteArticle($id);
        header('Location: /articles');
    }
}
?>
