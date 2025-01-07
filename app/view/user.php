<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;

$userController = new UserController();

try {
    $data = [
        'username' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 'password123'
    ];
    
    if ($userController->addUser($data)) {
        echo "Utilisateur ajouté avec succès";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}