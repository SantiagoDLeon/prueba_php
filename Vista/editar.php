<?php
require_once '../clases/Empleado.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$empleadoObj = new Empleado();
$empleado = $empleadoObj->obtenerPorId($_GET['id']);
$rolesEmpleado = $empleadoObj->obtenerRolesPorEmpleado($_GET['id']);

$db = new Database();
$conn = $db->conectar();

$areas = $conn->query("SELECT * FROM areas")->fetchAll(PDO::FETCH_ASSOC);
$roles = $conn->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Editar Empleado</h2>
    <form action="procesar_edicion.php" method="POST">
        <input type="hidden" name="id" value="<?= $empleado['id'] ?>">

        <label>Nombre completo *</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($empleado['nombre']) ?>" required><br><br>

        <label>Email *</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($empleado['email']) ?>" required><br><br>

        <label>Sexo *</label><br>
        <input type="radio" name="sexo" value="M" <?= $empleado['sexo'] === 'M' ? 'checked' : '' ?>> Masculino
        <input type="radio" name="sexo" value="F" <?= $empleado['sexo'] === 'F' ? 'checked' : '' ?>> Femenino<br><br>

        <label>Área *</label><br>
        <select name="area_id" required>
            <option value="">Seleccione...</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= $area['id'] ?>" <?= $empleado['area_id'] == $area['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Descripción *</label><br>
        <textarea name="descripcion" required><?= htmlspecialchars($empleado['descripcion']) ?></textarea><br><br>

        <label>
            <input type="checkbox" name="boletin" value="1" <?= $empleado['boletin'] ? 'checked' : '' ?>>
            Deseo recibir boletín informativo
        </label><br><br>

        <label>Roles *</label><br>
        <?php foreach ($roles as $rol): ?>
            <input type="checkbox" name="roles[]" value="<?= $rol['id'] ?>"
                <?= in_array($rol['id'], $rolesEmpleado) ? 'checked' : '' ?>>
            <?= htmlspecialchars($rol['nombre']) ?><br>
        <?php endforeach; ?>

        <br>
        <input type="submit" value="Actualizar">
    </form>
    <script src="assets/validar.js"></script>
</body>
</html>
