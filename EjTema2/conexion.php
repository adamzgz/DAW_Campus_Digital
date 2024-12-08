<?php
$host = 'localhost'; 
$usuario = 'root';   
$contraseña = '';    
$baseDeDatos = 'agenda';

$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>
