<?php

function route($path) {
    switch ($path) {
        case 'home':
            require_once '../app/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            break;

        case 'login':
            require_once '../app/Controllers/UserController.php';
            $controller = new UserController();
            $controller->login();
            break;

        case 'dashboard':
            require_once '../app/Controllers/AdminController.php';
            $controller = new AdminController();
            $controller->dashboard();
            break;

        case 'article':
            require_once '../app/Controllers/ArticleController.php';
            $controller = new ArticleController();
            $controller->show($_GET['id'] ?? null);
            break;

        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
}
