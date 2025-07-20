<?php
require_once '../clases/Empleado.php';

if (!isset($_POST['id'], $_POST['nombre'], $_POST['email'], $_POST['sexo'], $_POST['area_id'], $_POST['descripcion'], $_POST['roles'])) {
    die("Faltan datos obligatorios.");
}

$data = [
    'id' => $_POST['id'],
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'sexo' => $_POST['sexo'],
    'area_id' => $_POST['area_id'],
    'boletin' => isset($_POST['boletin']) ? 1 : 0,
    'descripcion' => $_POST['descripcion'],
    'roles' => $_POST['roles']
];

try {
    $empleado = new Empleado();
    $empleado->actualizar($data);

    header("Location: listar.php?actualizado=1");
    exit();
} catch (Exception $e) {
    echo "❌ Error al actualizar empleado: " . $e->getMessage();
}
