<?php
namespace App\Controllers;

require_once'../app/models/ArticleModel.php';

class ArticleController{
    // Afivhie tous les articles

    public function showAll(){
        $articles=\App\Models\ArticleModel::getAllArticle();
        include'../app/view/articleList.php';

    }
    //ajoute article
    public function creatArticle(){

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id'],
                'author_id' => $_POST['author_id']
            ];
            \App\Models\ArticleModel::addArticle($data);
            header('Location:/articles');
        }else{
            include'../app/views/articleForm.php';
        }

    }
    // modifiee article 
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id']
            ];
            \App\Models\ArticleModel::updateArticle($id, $data);
            header('Location: /articles');
        } else {
            $article = \App\Models\ArticleModel::getArticleById($id);
            include '../app/views/articleForm.php';
        }
    }

    //supprime
    public function delete($id){
        \App\Models\ArticleModel::deleteArticle($id);
        header('Location: /articles');


    }
}