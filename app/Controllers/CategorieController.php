<?php
namespace App\Controllers;
require_once __DIR__. '/../../vendor/autoload.php';
use Config\Database;
use App\Models\Model;
use App\Models\CategorieModel;




class CategorieController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategorieModel(); 
    }
    public function getCategory($id = null)  {
        if ($id) {
            $category = $this->categoryModel->showCategory('categories WHERE id = ' . $id);
            return $category[0]; 
        } else {
            $categories = $this->categoryModel->showCategory();
            return $categories;
        }
    }

    public function addCategory() {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            Model::addCategorie('categories', $data);
            header('Location: /category');
        }
    }

    public function modifieCategory($id) {
        if (isset($_POST['name'])) {
            $data = [
                'name' => $_POST['name']
            ];
            Model::updateCategory('categories', $id, $data);
            header('Location: /category');
        }
    }

    public function supprimeCategory($id) {
        Model::deletecategory('categories', $id);
        header('Location: /category');
    }

    public function getArticleCountByCategory() {
        return $this->categoryModel->getArticleCountByCategory();
    }

    /**
     * Récupérer les catégories les plus populaires.
     *
     * @return array
     */
    public function getMostPopularCategories() {
        return $this->categoryModel->getMostPopularCategories();
    }

    /**
     * Récupérer les tendances des catégories.
     *
     * @return array
     */
    public function getCategoryTrends() {
        return $this->categoryModel->getCategoryTrends();
    }

}




// // Simuler une requête POST pour ajouter une catégorie
// echo "Test d'ajout d'une catégorie :\n";
// $_POST = [
//     'action' => 'add',
//     'name' => 'PHP'
// ];
// $controller->addCategory();
// echo "Catégorie 'PHP' ajoutée.\n\n";

// // Simuler une requête POST pour modifier une catégorie
// echo "Test de modification d'une catégorie :\n";
// $_POST = [
//     'action' => 'edit',
//     'id' => 1, // ID de la catégorie à modifier
//     'name' => 'PHP Programming'
// ];
// $controller->modifieCategory(1);
// echo "Catégorie 'PHP' modifiée en 'PHP Programming'.\n\n";

// // Simuler une requête POST pour supprimer une catégorie
// echo "Test de suppression d'une catégorie :\n";
// $_POST = [
//     'action' => 'delete',
//     'id' => 1 // ID de la catégorie à supprimer
// ];
// $controller->supprimeCategory(1);
// echo "Catégorie 'PHP Programming' supprimée.\n\n";

// // Simuler une requête GET pour afficher la liste des catégories
// echo "Test d'affichage de la liste des catégories :\n";
// $categories = $controller->getCategory();
// if (!empty($categories)) {
//     foreach ($categories as $category) {
//         echo "ID: " . $category['id'] . ", Nom: " . $category['name'] . "\n";
//     }
// } else {
//     echo "Aucune catégorie trouvée.\n";
// }
?>