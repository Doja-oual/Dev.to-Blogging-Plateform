<?php
namespace app\Models;
use  App\config\Database;

class ArticleModel{

    //affichie tout les article

    public static function getAll(){
        $db= Database::getConnection();
        $query="
        SELECT articles.id,articles.title,articles.slug, articles.content, 
                   categories.name AS category_name
                   FROM articles
                   JOIN categories ON articles.category_id=categories.id 
                    LEFT JOIN article_tags ON articles.id=article_tags.article_id 
                    LEFT JOIN tags ON  article_tags.tag_id=tags.id
                    GROUP BY articles.id";

         $stmt=$db->prepare($query);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);           

    }

    public function addArticle($data){
        $db= Database::getConnection();
        $query="INSERT INTO articles(title, slug, content, category_id, author_id) VALUES (:title,:slug,:content,:category_id,:author_id)";
        $stmt=$db->prepare($query);
        $stmt->execute($data);


    }

    // modifie l'article
    public static function updateArticle($id,$data){
        $db= Database::getConnection();
        $query="UPDATE articles SET title = :title,slug = :slug, content = :content, category_id = :category_id WHERE id=:id";
        $data['id']=$id;
        $stmt=$db->prepare($query);
        $stmt->execute($data);


    }
    public static function deleteArticle($id){
        $db= Database::getConnection();
        $query="DELETE FROM articles WHERE id=:id";
        $stmt=$db->prepare($query);
        $stmt->execute(['id'=>$id]);





    } 
}



?>