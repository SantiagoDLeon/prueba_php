<?php
require_once '../clases/Database.php';

// Cargar áreas y roles desde la base de datos
$db = new Database();
$conn = $db->conectar();

$areas = $conn->query("SELECT * FROM areas")->fetchAll(PDO::FETCH_ASSOC);
$roles = $conn->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Empleado</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Formulario de Registro de Empleado</h2>
    <form action="procesar_creacion.php" method="POST">
        <label>Nombre completo *</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Email *</label><br>
        <input type="email" name="email" required><br><br>

        <label>Sexo *</label><br>
        <input type="radio" name="sexo" value="M" required> Masculino
        <input type="radio" name="sexo" value="F"> Femenino<br><br>

        <label>Área *</label><br>
        <select name="area_id" required>
            <option value="">Seleccione...</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= $area['id'] ?>"><?= $area['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Descripción *</label><br>
        <textarea name="descripcion" required></textarea><br><br>

        <label>
            <input type="checkbox" name="boletin" value="1">
            Deseo recibir boletín informativo
        </label><br><br>

        <label>Roles *</label><br>
        <?php foreach ($roles as $rol): ?>
            <input type="checkbox" name="roles[]" value="<?= $rol['id'] ?>"> <?= $rol['nombre'] ?><br>
        <?php endforeach; ?>
        <br>

        <input type="submit" value="Guardar">
    </form>
    <script src="assets/validar.js"></script>
</body>
</html>
