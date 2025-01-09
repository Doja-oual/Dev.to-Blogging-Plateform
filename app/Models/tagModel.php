<?php
namespace App\Models;
require_once '../../vendor/autoload.php';
use Config\Database;

class TagModel extends Model {
    protected $table = 'tags';

    public function __construct() {
        $this->conn = Database::getConnection();
    }

   
    public function show() {
        return parent::show($this->table);
    }

    public function countItems() {
        return parent::countItems($this->table);
    }

    public function add($data) {
        return parent::add($this->table, $data);
    }

    public function update($id, $data) {
        return parent::update($this->table, $id, $data);
    }

    public function delete($id) {
        return parent::delete($this->table, $id);
    }
}
?>
