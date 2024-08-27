<?php
include_once 'conexion.php';

$color_1 = $_POST['color_1'];
$color_2 = $_POST['color_2'];
$color_3 = $_POST['color_3'];
$mensaje_banner = $_POST['mensaje_banner'];
$informacion_quienes_somos = $_POST['informacion_quienes_somos'];
$enlace_facebook = $_POST['enlace_facebook'];
$enlace_youtube = $_POST['enlace_youtube'];
$enlace_instagram = $_POST['enlace_instagram'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

function subirImagen($fileInput)
{
    $directorioRelativo = "./assets/img/";  // Cambio de "./" a "../"
    $archivoRelativo = $directorioRelativo . basename($_FILES[$fileInput]["name"]);
    $directorioAbsoluto = "../assets/img/";
    $archivoAbsoluto = $directorioAbsoluto . basename($_FILES[$fileInput]["name"]);
    $tipoArchivo = strtolower(pathinfo($archivoAbsoluto, PATHINFO_EXTENSION));

    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['size'] > 0) {
        if ($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png" || $tipoArchivo == "gif" || $tipoArchivo == "webp") {
            if (move_uploaded_file($_FILES[$fileInput]["tmp_name"], $archivoAbsoluto)) {
                return $archivoRelativo;
            }
        }
    }
    return null;
}


function actualizarImagenEnBD($conection, $id, $direccion)
{
    $sql = "UPDATE imagenes SET direccion = ? WHERE id = ?";
    $stmt = mysqli_prepare($conection, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $direccion, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$icono_principal = subirImagen('icono_principal');
$imagen_banner = subirImagen('imagen_banner');
$imagen_quienes_somos = subirImagen('imagen_quienes_somos');

$sql = "UPDATE configuracionsitio SET ";

$params = [];
$types = '';

if (!empty($color_1)) {
    $sql .= "color_1 = ?, ";
    array_push($params, $color_1);
    $types .= 's';
}
if (!empty($color_2)) {
    $sql .= "color_2 = ?, ";
    array_push($params, $color_2);
    $types .= 's';
}
if (!empty($color_3)) {
    $sql .= "color_3 = ?, ";
    array_push($params, $color_3);
    $types .= 's';
}
if (!empty($mensaje_banner)) {
    $sql .= "mensaje_banner = ?, ";
    array_push($params, $mensaje_banner);
    $types .= 's';
}
if (!empty($informacion_quienes_somos)) {
    $sql .= "informacion_quienes_somos = ?, ";
    array_push($params, $informacion_quienes_somos);
    $types .= 's';
}
if (!empty($enlace_facebook)) {
    $sql .= "enlace_facebook = ?, ";
    array_push($params, $enlace_facebook);
    $types .= 's';
}
if (!empty($enlace_youtube)) {
    $sql .= "enlace_youtube = ?, ";
    array_push($params, $enlace_youtube);
    $types .= 's';
}
if (!empty($enlace_instagram)) {
    $sql .= "enlace_instagram = ?, ";
    array_push($params, $enlace_instagram);
    $types .= 's';
}
if (!empty($direccion)) {
    $sql .= "direccion = ?, ";
    array_push($params, $direccion);
    $types .= 's';
}
if (!empty($telefono)) {
    $sql .= "telefono = ?, ";
    array_push($params, $telefono);
    $types .= 's';
}
if (!empty($email)) {
    $sql .= "email = ?, ";
    array_push($params, $email);
    $types .= 's';
}

if ($icono_principal) {
    actualizarImagenEnBD($conection, 1, $icono_principal);
}
if ($imagen_banner) {
    actualizarImagenEnBD($conection, 2, $imagen_banner);
}
if ($imagen_quienes_somos) {
    actualizarImagenEnBD($conection, 3, $imagen_quienes_somos);
}

$sql = rtrim($sql, ', ');

if (strpos($sql, 'SET') !== false && strpos($sql, 'SET') < strlen($sql) - 5) {
    $sql .= " WHERE id = 1";
    
    $stmt = mysqli_prepare($conection, $sql);
    
    if (!empty($types)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: ../personalizar.php");
    } else {
        header("Location: ../personalizar.php");
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../personalizar.php");
}

mysqli_close($conection);
