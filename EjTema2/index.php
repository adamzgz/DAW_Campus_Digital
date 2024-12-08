<?php
include 'conexion.php';
include 'funciones.php';

$error = "";
$mensaje = "";

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'añadir') {
        // Obtener valores del formulario
        $nombre = trim($_POST['nombre'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if (empty($nombre)) {
            $error = "El nombre es obligatorio.";
        } else {
            // Gestionar el contacto
            gestionarContacto($conexion, $nombre, $telefono);

            // Mensaje accion
            if (!empty($telefono)) {
                $mensaje = "Contacto '$nombre' guardado o actualizado.";
            } else {
                $mensaje = "Contacto '$nombre' eliminado.";
            }
        }
    }

    if (isset($_POST['vaciar']) && $_POST['vaciar'] == 1) {
        // Vaciar la agenda
        vaciarAgenda($conexion);
        $mensaje = "Todos los contactos han sido eliminados.";
    }
}

// Obtener la lista actualizada de contactos
$contactos = obtenerContactos($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="agenda-container">
        <h1>Agenda</h1>

        
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif (!empty($mensaje)): ?>
            <p style="color: green; text-align: center;"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <!-- Listar contactos -->
        <div class="contactos section">
            <h3>Contactos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($contactos)): ?>
                        <?php foreach ($contactos as $nombre => $telefono): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($nombre); ?></td>
                                <td><?php echo htmlspecialchars($telefono); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" style="text-align: center;">No hay contactos en la agenda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario -->
        <div class="section">
            <form method="POST">
                <div class="form-row">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre">
                </div>
                <div class="form-row">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono">
                </div>
                <div class="form-row">
                    <button type="submit" name="accion" value="añadir">Añadir/Actualizar</button>
                    <button type="submit" name="vaciar" value="1">Vaciar Agenda</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
