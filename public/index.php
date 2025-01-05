<?php
require_once '../app/core/Router.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/ArticleController.php';
require_once '../app/controllers/CategoryController.php';
require_once '../app/controllers/TagController.php';

// Créer une instance du Router
$router = new App\Core\Router();

// Ajouter des routes
$router->add('', 'AuthController');
$router->add('admin', 'AdminController');
$router->add('articles', 'ArticleController');
$router->add('categories', 'CategoryController');
$router->add('tags', 'TagController');

// Démarrer le routage
$router->dispatch();
