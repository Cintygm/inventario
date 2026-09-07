# Inventario Básico — PHP + MySQL + MVC

Aplicación web para gestionar un inventario básico de productos, siguiendo el patrón modelo visto controlador.

## Estructura del proyecto

inventario-basico/
├── index.php                      # Front controller (enrutador)
├── config/
│   └── conexion.php                # Conexión PDO a MySQL
├── controllers/
│   └── ProductoController.php      # Lógica de control (recibe acciones del usuario)
├── models/
│   └── Producto.php                # Acceso a datos (INSERT, SELECT, UPDATE, DELETE)
├── views/
│   ├── partials/
│   │   ├── header.php
│   │   └── footer.php
│   └── productos/
│       ├── listar.php              # Tabla con listado + búsqueda
│       ├── crear.php               # Formulario de registro
│       └── editar.php              # Formulario de edición
├── css/estilos.css
├── js/script.js                    # Validaciones del formulario
└── database/integradora.sql        # Script de creación de la BD

## Requisitos

  PHP
  MySQL / MariaDB
  Servidor local: XAMPP, WAMP

## Instalación

1. **Base de datos**
   Abrir phpMyAdmin 

2. **Configuración**
   config/conexion.php conexión de la base de datos

3. **Ejecutar el proyecto**
   Con XAMPP o WAMP

## Funcionalidades
Listado de productos
Registro de nuevo producto (Vista → Controlador → Modelo → MySQL)
Edición de producto existente
Eliminación con confirmación
Búsqueda por nombre o categoría
Validaciones en JavaScript (campos vacíos, numéricos, longitud, valores incorrectos)
Indicadores de stock bajo (tarjetas resumen)

