<?php
require_once '../clases/Empleado.php';

// Verificar que los campos obligatorios existan
if (!isset($_POST['nombre'], $_POST['email'], $_POST['sexo'], $_POST['area_id'], $_POST['descripcion'], $_POST['roles'])) {
    die("Faltan datos obligatorios.");
}

// Preparar los datos
$data = [
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'sexo' => $_POST['sexo'],
    'area_id' => $_POST['area_id'],
    'boletin' => isset($_POST['boletin']) ? 1 : 0,
    'descripcion' => $_POST['descripcion'],
    'roles' => $_POST['roles'] // array de ids de roles
];

try {
    $empleado = new Empleado();
    $id = $empleado->crear($data);

    echo '<div class="mensaje-exito">
        ✅ El empleado fue registrado correctamente.
      </div>
      <br>
      <a href="crear.php">← Volver</a> | <a href="listar.php">Ver lista</a>';
    } catch (Exception $e) {
    echo "❌ Error al guardar: " . $e->getMessage();
}
?>
