<?php

include 'conexion.php';
session_start();

if (isset($_POST['submit'])) {
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : false;
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : false;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : false;
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : false;

    $errores = array();

    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $val_correo = true;
    } else {
        $errores['correo'] = "Correo electrónico incorrecto";
    }

    if (!empty($usuario)) {
        $val_usuario = true;
    } else {
        $errores['usuario'] = "Usuario incorrecto";
    }

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $val_nombre = true;
    } else {
        $errores['nombre'] = "Nombre incorrecto";
    }

    if (!empty($telefono) && is_numeric($telefono)) {
        $val_telefono = true;
    } else {
        $errores['telefono'] = "Teléfono incorrecto";
    }

    if (!empty($contrasena)) {
        $val_contrasena = true;
    } else {
        $errores['contrasena'] = "Contraseña incorrecta";
    }

    if (count($errores) == 0) {
        $pass_encrip = password_hash($contrasena, PASSWORD_BCRYPT, ['cost' => 4]);
        $privilegio = 'publico';
        $sql = "INSERT INTO usuarios (nombre, telefono, correo, usuario, contraseña, privilegio) 
                VALUES ('$nombre', '$telefono', '$correo', '$usuario', '$pass_encrip', '$privilegio');";

        $insertar = mysqli_query($conection, $sql);

        if ($insertar) {
            header("Location: ../login.php");
            exit();
        } else {
            echo "Error de ingreso: " . mysqli_error($conex);
        }
    } else {
        $_SESSION['errores'] = $errores;
        echo 'error';
        exit();
    }
}
