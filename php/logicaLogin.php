<?php
session_start();
include 'conexion.php';

if (isset($_POST['login'])) {
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : false;
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : false;

    $errores = array();

    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $val_correo = true;
    } else {
        $errores['correo'] = "Correo electrónico incorrecto";
    }

    if (!empty($contrasena)) {
        $val_contrasena = true;
    } else {
        $errores['contrasena'] = "Contraseña incorrecta";
    }

    if (count($errores) == 0) {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $resultado = mysqli_query($conection, $sql);

        if ($resultado && mysqli_num_rows($resultado) == 1) {
            $usuario = mysqli_fetch_assoc($resultado);

            if (password_verify($contrasena, $usuario['contraseña'])) {
                $_SESSION['usuario'] = $usuario;
                if ($usuario['privilegio'] == 'administrador') {
                    header("Location: ../index.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                $errores['login'] = "Credenciales incorrectas";
            }
        } else {
            $errores['login'] = "Usuario no encontrado";
        }
    }
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header("Location: ../login.php");
        exit();
    }
}

mysqli_close($conection);
