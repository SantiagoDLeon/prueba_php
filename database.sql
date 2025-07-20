CREATE DATABASE IF NOT EXISTS prueba_php;
USE prueba_php;

-- Tabla de áreas
CREATE TABLE areas (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del área de la empresa'
);

-- Tabla de roles
CREATE TABLE roles (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del rol'
);

-- Tabla de empleados
CREATE TABLE empleados (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre completo del empleado',
    email VARCHAR(255) NOT NULL COMMENT 'Correo electrónico del empleado',
    sexo CHAR(1) NOT NULL COMMENT 'M para Masculino. F para Femenino',
    area_id INT(11) NOT NULL COMMENT 'Área de la empresa',
    boletin TINYINT(1) DEFAULT 0 COMMENT '1 para recibir boletín, 0 para no',
    descripcion TEXT COMMENT 'Experiencia del empleado',
    FOREIGN KEY (area_id) REFERENCES areas(id)
);

-- Tabla pivote para muchos a muchos: empleados - roles
CREATE TABLE empleado_rol (
    empleado_id INT(11) NOT NULL,
    rol_id INT(11) NOT NULL,
    PRIMARY KEY (empleado_id, rol_id),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE
);