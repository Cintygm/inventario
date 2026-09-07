<?php
require_once __DIR__ . '/../config/conexion.php';


class Producto {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    /** Obtiene todos los productos, opcionalmente filtrados por búsqueda */
    public function obtenerTodos($busqueda = '') {
        if ($busqueda !== '') {
            $stmt = $this->db->prepare(
                "SELECT * FROM productos WHERE nombre LIKE :busqueda OR categoria LIKE :busqueda ORDER BY id DESC"
            );
            $like = "%$busqueda%";
            $stmt->bindParam(':busqueda', $like);
            $stmt->execute();
        } else {
            $stmt = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        }
        return $stmt->fetchAll();
    }

    /** Obtiene un producto por su ID */
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /** Inserta un nuevo producto */
    public function crear($datos) {
        $sql = "INSERT INTO productos (nombre, categoria, precio, cantidad, descripcion)
                VALUES (:nombre, :categoria, :precio, :cantidad, :descripcion)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    /** Actualiza un producto existente */
    public function actualizar($id, $datos) {
        $sql = "UPDATE productos
                SET nombre = :nombre, categoria = :categoria, precio = :precio,
                    cantidad = :cantidad, descripcion = :descripcion
                WHERE id = :id";
        $datos['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    /** Elimina un producto por ID */
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /** Cuenta cuántos productos hay con stock bajo (<=5), para el dashboard */
    public function contarStockBajo() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM productos WHERE cantidad <= 5");
        return $stmt->fetch()['total'];
    }

    /** Total de unidades en inventario */
    public function totalUnidades() {
        $stmt = $this->db->query("SELECT COALESCE(SUM(cantidad),0) as total FROM productos");
        return $stmt->fetch()['total'];
    }
}
