<?php

// Obtener todos los contactos desde la base de datos
function obtenerContactos($conexion) {
    $sql = "SELECT nombre, telefono FROM contactos";
    $resultado = $conexion->query($sql);

    $contactos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $contactos[$fila['nombre']] = $fila['telefono'];
    }
    return $contactos;
}

// Guardar o actualizar contacto según las condiciones
function gestionarContacto($conexion, $nombre, $telefono) {
    // Verificar si el contacto existe
    $sql = "SELECT nombre FROM contactos WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $nombre);
    $stmt->execute();
    $stmt->store_result();
    $existe = $stmt->num_rows > 0;
    $stmt->close();

    if (!$existe && !empty($telefono)) {
        // Si el contacto no existe y el teléfono no está vacío, añadirlo
        $sql = "INSERT INTO contactos (nombre, telefono) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ss', $nombre, $telefono);
        $stmt->execute();
        $stmt->close();
    } elseif ($existe && !empty($telefono)) {
        // Si el contacto existe y se indica un teléfono, actualizarlo
        $sql = "UPDATE contactos SET telefono = ? WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ss', $telefono, $nombre);
        $stmt->execute();
        $stmt->close();
    } elseif ($existe && empty($telefono)) {
        // Si el contacto existe y no se indica teléfono, eliminarlo
        eliminarContacto($conexion, $nombre);
    }
}

// Eliminar un contacto
function eliminarContacto($conexion, $nombre) {
    $sql = "DELETE FROM contactos WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $nombre);
    $stmt->execute();
    $stmt->close();
}

// Vaciar toda la agenda
function vaciarAgenda($conexion) {
    $conexion->query("DELETE FROM contactos");
}
?>
