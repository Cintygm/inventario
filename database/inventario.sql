-- Base de datos: integradora
-- Proyecto: Inventario Básico (MVC - PHP - MySQL)

CREATE DATABASE IF NOT EXISTS integradora
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE integradora;

CREATE TABLE IF NOT EXISTS productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0,
  cantidad INT NOT NULL DEFAULT 0,
  descripcion VARCHAR(255) DEFAULT '',
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Datos de ejemplo (opcional, se pueden borrar)
INSERT INTO productos (nombre, categoria, precio, cantidad, descripcion) VALUES
('Mouse inalámbrico', 'Tecnología', 12.50, 20, 'Mouse óptico inalámbrico USB'),
('Teclado mecánico', 'Tecnología', 35.00, 8, 'Teclado retroiluminado switches rojos'),
('Resma de papel A4', 'Oficina', 4.75, 3, 'Paquete de 500 hojas tamaño A4'),
('Silla ergonómica', 'Mobiliario', 89.99, 5, 'Silla de oficina con soporte lumbar');
