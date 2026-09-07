<?php
require_once __DIR__ . '/../models/Producto.php';


class ProductoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Producto();
    }

    /** Lista todos los productos (con búsqueda opcional) */
    public function listar() {
        $busqueda   = trim($_GET['q'] ?? '');
        $productos  = $this->modelo->obtenerTodos($busqueda);
        $stockBajo  = $this->modelo->contarStockBajo();
        $totalUnid  = $this->modelo->totalUnidades();
        require __DIR__ . '/../views/productos/listar.php';
    }

    /** Muestra el formulario de creación */
    public function crear() {
        $producto = null;
        $errores  = [];
        require __DIR__ . '/../views/productos/crear.php';
    }

    /** Procesa el guardado de un nuevo producto */
    public function guardar() {
        $errores = $this->validar($_POST);

        if (!empty($errores)) {
            $producto = $_POST;
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        $this->modelo->crear([
            'nombre'      => trim($_POST['nombre']),
            'categoria'   => trim($_POST['categoria']),
            'precio'      => $_POST['precio'],
            'cantidad'    => $_POST['cantidad'],
            'descripcion' => trim($_POST['descripcion'] ?? '')
        ]);

        header("Location: index.php?action=listar&msg=creado");
        exit;
    }

    /** Muestra el formulario de edición precargado */
    public function editar() {
        $id = $_GET['id'] ?? null;
        $producto = $this->modelo->obtenerPorId($id);
        $errores = [];

        if (!$producto) {
            header("Location: index.php?action=listar");
            exit;
        }
        require __DIR__ . '/../views/productos/editar.php';
    }

    /** Procesa la actualización de un producto */
    public function actualizar() {
        $id = $_POST['id'] ?? null;
        $errores = $this->validar($_POST);

        if (!$id || !empty($errores)) {
            $producto = $_POST;
            require __DIR__ . '/../views/productos/editar.php';
            return;
        }

        $this->modelo->actualizar($id, [
            'nombre'      => trim($_POST['nombre']),
            'categoria'   => trim($_POST['categoria']),
            'precio'      => $_POST['precio'],
            'cantidad'    => $_POST['cantidad'],
            'descripcion' => trim($_POST['descripcion'] ?? '')
        ]);

        header("Location: index.php?action=listar&msg=actualizado");
        exit;
    }

    /** Elimina un producto */
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?action=listar&msg=eliminado");
        exit;
    }

    /** Validación de datos del formulario (servidor) */
    private function validar($datos) {
        $errores = [];

        if (empty(trim($datos['nombre'] ?? ''))) {
            $errores['nombre'] = 'El nombre del producto es obligatorio.';
        } elseif (strlen(trim($datos['nombre'])) < 3 || strlen(trim($datos['nombre'])) > 100) {
            $errores['nombre'] = 'El nombre debe tener entre 3 y 100 caracteres.';
        }

        if (empty(trim($datos['categoria'] ?? ''))) {
            $errores['categoria'] = 'Debe seleccionar una categoría.';
        }

        if (!isset($datos['precio']) || $datos['precio'] === '' || !is_numeric($datos['precio']) || $datos['precio'] < 0) {
            $errores['precio'] = 'El precio debe ser un número válido mayor o igual a 0.';
        }

        if (!isset($datos['cantidad']) || $datos['cantidad'] === '' || !ctype_digit((string)$datos['cantidad'])) {
            $errores['cantidad'] = 'La cantidad debe ser un número entero válido.';
        }

        if (isset($datos['descripcion']) && strlen($datos['descripcion']) > 255) {
            $errores['descripcion'] = 'La descripción no debe superar 255 caracteres.';
        }

        return $errores;
    }
}
