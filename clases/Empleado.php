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

    // Más adelante agregaremos editar, eliminar, obtenerPorId...
}
?>
