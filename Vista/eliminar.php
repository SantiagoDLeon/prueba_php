<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../clases/Empleado.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = $_GET['id'];

try {
    $empleado = new Empleado();
    $empleado->eliminar($id);

    header("Location: listar.php?eliminado=1");
    exit();
} catch (Exception $e) {
    echo "❌ Error al eliminar empleado: " . $e->getMessage();
}
