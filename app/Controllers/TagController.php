<?php
namespace App\Controllers;

require_once __DIR__. '/../../vendor/autoload.php';
use Config\Database;
use App\Models\Model;

class TagController {

    public function getTag($id = null) {
        if ($id) {
            $tag = Model::show('tags WHERE id = ' . $id);
            include '../app/view/tag.php';
        } else {
            $tag = Model::show('tags');
            return $tag;
        }
    }

    public function addTag() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            Model::add('tags', $data);
            header('Location: /tag');
        }
    }

    public function modifieTag($id) {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            Model::update('tags', $id, $data);
            header('Location: /tag');
        }
    }

    public function supprimeTag($id) {
        Model::delete('tags', $id);
        header('Location: /tag');
    }
}
?>
