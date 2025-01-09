<?php
namespace App\Models;
require_once __DIR__.'/../../vendor/autoload.php';
use Config\Database;
// use App\Models\Model;

class CategorieModel extends Model {

    protected $table = 'categories';

    public function __construct() {
        $this->conn = Database::getConnection();
    }
    // public function getArticleCountByCategory() {
    //     return Model ::getCountByRelation('categories', 'articles', 'category_id');
    // }

    public function getMostPopularCategories() {
        return Model::getMostPopular('categories', 'articles', 'category_id', 'views');
    }
    public function getCategoryTrends() {
        return Model::getTrends('categories', 'articles', 'category_id', 'created_at');
    }

    public function showCategory() {
        return parent::show($this->table);
    }

    // public function countItems() {
    //     return parent::countItems($this->table);
    // }

    public function addCategorie($data) {
        return parent::add($this->table, $data);
    }

    public function updateCategory($id, $data) {
        return parent::update($this->table, $id, $data);
    }

    public function deletecategory($id) {
        return parent::delete($this->table, $id);
    }
}
?>
