# prueba_php

Aplicación CRUD desarrollada en PHP con MySQL. Permite registrar, listar, editar y eliminar empleados, usando programación orientada a objetos (POO), validación con JavaScript y PHP.

---

## Tecnologías utilizadas

- PHP (POO)
- MySQL
- HTML5
- CSS3
- JavaScript (validación en cliente)
- phpMyAdmin (gestión de base de datos)
- XAMPP (entorno local)


---

## Instalación y configuración
- tener xampp instalado

1. Clona el repositorio y copia los archivos en tu carpeta `htdocs` de xampp:

2. Inicia Apache y MySQL desde el panel de XAMPP.

---

## Importa la base de datos

1. Abre tu navegador y entra a: http://localhost/phpmyadmin

2. Crea una nueva base de datos con el nombre: prueba_php

3. Ve a la pestaña Importar

4. Selecciona el archivo database.sql (que ya viene en el repositorio)

5. Haz clic en Continuar

Esto creará las tablas y agregará los datos iniciales de prueba (áreas, roles, empleados).

---

## Base de datos versionada

El archivo database.sql contiene:

Estructura completa de la base de datos (empleados, areas, roles, empleado_rol)

Datos de ejemplo precargados

---

## Uso de la aplicación

- `http://localhost/prueba_php/vista/crear.php`  
  Formulario para registrar empleados.

- `http://localhost/prueba_php/vista/listar.php`  
  Tabla con empleados, permite editar y eliminar.

---
