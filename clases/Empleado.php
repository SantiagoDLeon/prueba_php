<?php
require_once 'Database.php';

class Empleado {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar() {
        $sql = "SELECT empleados.*, areas.nombre AS area_nombre
                FROM empleados
                INNER JOIN areas ON empleados.area_id = areas.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM empleados WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function obtenerRolesPorEmpleado($empleado_id) {
    $stmt = $this->conn->prepare("SELECT r.nombre FROM empleado_rol er 
                                  INNER JOIN roles r ON er.rol_id = r.id 
                                  WHERE er.empleado_id = ?");
    $stmt->execute([$empleado_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function crear($data) {
        $stmt = $this->conn->prepare("INSERT INTO empleados 
            (nombre, email, sexo, area_id, boletin, descripcion) 
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            $data['boletin'],
            $data['descripcion']
        ]);

        $empleado_id = $this->conn->lastInsertId();

        // Insertar roles (relación muchos a muchos)
        foreach ($data['roles'] as $rol_id) {
            $stmt = $this->conn->prepare("INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)");
            $stmt->execute([$empleado_id, $rol_id]);
        }

        return $empleado_id;
    }

    public function eliminar($id) {
    // Primero eliminar los roles asociados
    $stmt = $this->conn->prepare("DELETE FROM empleado_rol WHERE empleado_id = ?");
    $stmt->execute([$id]);

    // Luego eliminar al empleado
    $stmt = $this->conn->prepare("DELETE FROM empleados WHERE id = ?");
    $stmt->execute([$id]);
    }

    public function actualizar($data) {
    // Actualizar datos del empleado
    $stmt = $this->conn->prepare("UPDATE empleados SET 
        nombre = ?, email = ?, sexo = ?, area_id = ?, boletin = ?, descripcion = ?
        WHERE id = ?");
    $stmt->execute([
        $data['nombre'],
        $data['email'],
        $data['sexo'],
        $data['area_id'],
        $data['boletin'],
        $data['descripcion'],
        $data['id']
    ]);

    // Eliminar roles actuales
    $stmt = $this->conn->prepare("DELETE FROM empleado_rol WHERE empleado_id = ?");
    $stmt->execute([$data['id']]);

    // Insertar nuevos roles
    foreach ($data['roles'] as $rol_id) {
        $stmt = $this->conn->prepare("INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)");
        $stmt->execute([$data['id'], $rol_id]);
        }
    }

    
}
?>
