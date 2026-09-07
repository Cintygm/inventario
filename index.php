<?php
require_once __DIR__ . '/controllers/ProductoController.php';

$controller = new ProductoController();
$action = $_GET['action'] ?? 'listar';

switch ($action) {
    case 'crear':
        $controller->crear();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    case 'listar':
    default:
        $controller->listar();
        break;
}
