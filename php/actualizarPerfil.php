<?php
include './session.php';
include './conexion.php';

$usuario_id = $_POST['usuario_id'];
$nombre = mysqli_real_escape_string($conection, $_POST['nombre']);
$telefono = mysqli_real_escape_string($conection, $_POST['telefono']);
$correo = mysqli_real_escape_string($conection, $_POST['correo']);
$nombre_usuario = mysqli_real_escape_string($conection, $_POST['nombre_usuario']);

$query = "UPDATE usuarios SET nombre='$nombre', telefono='$telefono', correo='$correo', usuario='$nombre_usuario' WHERE id='$usuario_id'";
$result = mysqli_query($conection, $query);

if ($result) {
    header('Location: ../miPerfil.php');
}
