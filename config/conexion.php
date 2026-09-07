<?php

class Conexion {
    private static $host   = "localhost";
    private static $usuario = "root";
    private static $clave   = "";
    private static $bd      = "integradora";
    private static $conexion = null;

    public static function conectar() {
        if (self::$conexion === null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$bd . ";charset=utf8mb4",
                    self::$usuario,
                    self::$clave,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
