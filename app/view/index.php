<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TagController;

$controller = new TagController();

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'add':
        $controller->addCategory();
        break;
    case 'edit':
        $controller->modify($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->get($id);
        break;
}
