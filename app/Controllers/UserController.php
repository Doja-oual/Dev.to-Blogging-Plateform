<?php
namespace App\Controllers;
require_once '../../vendor/autoload.php';
use App\Models\UserModel;

class UserController {
    public function getAllUsers() {
        try {
            return UserModel::getAllUsers();
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    public function addUser($data) {
        try {
            if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
                throw new \Exception("Tous les champs requis doivent être remplis");
            }
            
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("Format d'email invalide");
            }
            
            return UserModel::addUser($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function updateUser($id, $data) {
        try {
            if (empty($id)) {
                throw new \Exception("ID utilisateur requis");
            }
            
            return UserModel::updateUser($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function deleteUser($id) {
        try {
            if (empty($id)) {
                throw new \Exception("ID utilisateur requis");
            }
            
            return UserModel::deleteUser($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function getUserById($id) {
        try {
            return UserModel::getUserById($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}

$userController = new UserController();

// Ajouter un utilisateur
try {
    $data = [
        'username' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 'password123',
        'bio' => 'Hello, I am John!'
    ];
    
    if ($userController->addUser($data)) {
        echo "Utilisateur ajouté avec succès";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

// Récupérer tous les utilisateurs
$users = $userController->getAllUsers();

// Mettre à jour un utilisateur
try {
    $updateData = [
        'username' => 'John Doe Updated',
        'email' => 'john.updated@example.com',
        'bio' => 'Updated bio'
    ];
    
    if ($userController->updateUser(1, $updateData)) {
        echo "Utilisateur mis à jour avec succès";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}


