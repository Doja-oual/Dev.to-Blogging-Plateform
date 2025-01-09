<?php
namespace App\Controllers;
require_once __DIR__. '/../../vendor/autoload.php';
use Config\Database;
use App\Models\Model;

class TagController {

    // Récupérer tous les tags ou un tag spécifique par ID
    public function getTag($id = null) {
        if ($id) {
            $tag =Model::show('tags WHERE id = ' . $id); 
            return $tag[0] ; 
        } else {
            $tage = Model::show('tags'); 
            return $tage;

        }
    }

    // Ajouter un tag
    public function addTag() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            $tagModel = new TagModel();
            $tagModel->add($data); // Utiliser la méthode add du TagModel
            header('Location: /tag');
            exit();
        }
    }

    // Modifier un tag
    public function modifieTag($id) {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            $tagModel = new TagModel();
            $tagModel->update($id, $data); // Utiliser la méthode update du TagModel
            header('Location: /tag');
            exit();
        }
    }

    // Supprimer un tag
    public function supprimeTag($id) {
        $tagModel = new TagModel();
        $tagModel->delete($id); // Utiliser la méthode delete du TagModel
        header('Location: /tag');
        exit();
    }
}
?>