<?php
require_once '../clases/Empleado.php';

$empleado = new Empleado();
$empleados = $empleado->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
</head>
<body>
    <h2>Empleados Registrados</h2>
    <a href="crear.php">+ Crear nuevo empleado</a><br><br>

    <?php if (count($empleados) > 0): ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Área</th>
                    <th>Boletín</th>
                    <th>Descripción</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $emp): ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['nombre']) ?></td>
                        <td><?= htmlspecialchars($emp['email']) ?></td>
                        <td><?= $emp['sexo'] === 'M' ? 'Masculino' : 'Femenino' ?></td>
                        <td><?= htmlspecialchars($emp['area_nombre']) ?></td>
                        <td><?= $emp['boletin'] ? 'Sí' : 'No' ?></td>
                        <td><?= nl2br(htmlspecialchars($emp['descripcion'])) ?></td>
                        <td>
                            <?php
                            $roles = $empleado->obtenerRolesPorEmpleado($emp['id']);
                            echo implode(', ', array_map('htmlspecialchars', $roles));
                            ?>
                        </td>
                        <td>
                            <a href="editar.php?id=<?= $emp['id'] ?>">Editar</a> |
                            <a href="eliminar.php?id=<?= $emp['id'] ?>" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay empleados registrados aún.</p>
    <?php endif; ?>
</body>
</html>
