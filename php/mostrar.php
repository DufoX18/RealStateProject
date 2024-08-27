<?php
include_once 'php/conexion.php';

function obtenerDatoColumna($columna)
{
    global $conection;

    $sql = "SELECT $columna FROM configuracionsitio";
    $result = mysqli_query($conection, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row[$columna];
    } else {
        return null;
    }
}

function obtenerDireccionImagen($id_imagen)
{
    global $conection;

    $sql = "SELECT direccion FROM imagenes WHERE id = ?";
    $stmt = mysqli_prepare($conection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_imagen);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $direccion);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $direccion;
}

function mostrarImagen($columna)
{
    $id_imagen = obtenerDatoColumna($columna);

    if ($id_imagen !== null) {
        $direccion_imagen = obtenerDireccionImagen($id_imagen);
        if ($direccion_imagen) {
            echo htmlspecialchars($direccion_imagen);
        } else {
            echo "Imagen no encontrada";
        }
    } else {
        echo "No disponible";
    }
}

function mostrarColor1()
{
    $color_1 = obtenerDatoColumna('color_1');
    echo htmlspecialchars($color_1);
}

function mostrarColor2()
{
    $color_2 = obtenerDatoColumna('color_2');
    echo htmlspecialchars($color_2);
}

function mostrarColor3()
{
    $color_3 = obtenerDatoColumna('color_3');
    echo htmlspecialchars($color_3);
}

function mostrarMensajeBanner()
{
    $mensaje_banner = obtenerDatoColumna('mensaje_banner');
    echo htmlspecialchars($mensaje_banner);
}

function mostrarInformacionQuienesSomos()
{
    $informacion_quienes_somos = obtenerDatoColumna('informacion_quienes_somos');
    echo htmlspecialchars($informacion_quienes_somos);
}

function mostrarEnlaceTwitter()
{
    $enlace_twitter = obtenerDatoColumna('enlace_twitter');
    echo htmlspecialchars($enlace_twitter);
}

function mostrarEnlaceFacebook()
{
    $enlace_facebook = obtenerDatoColumna('enlace_facebook');
    echo htmlspecialchars($enlace_facebook);
}

function mostrarEnlaceYoutube()
{
    $enlace_youtube = obtenerDatoColumna('enlace_youtube');
    echo htmlspecialchars($enlace_youtube);
}

function mostrarEnlaceInstagram()
{
    $enlace_instagram = obtenerDatoColumna('enlace_instagram');
    echo htmlspecialchars($enlace_instagram);
}

function mostrarDireccion()
{
    $direccion = obtenerDatoColumna('direccion');
    echo htmlspecialchars($direccion);
}

function mostrarTelefono()
{
    $telefono = obtenerDatoColumna('telefono');
    echo htmlspecialchars($telefono);
}

function mostrarEmail()
{
    $email = obtenerDatoColumna('email');
    echo htmlspecialchars($email);
}

function mostrarIconoPrincipal()
{
    mostrarImagen('icono_principal_id');
}

function mostrarImagenBanner()
{
    mostrarImagen('imagen_banner_id');
}

function mostrarImagenQuienesSomos()
{
    mostrarImagen('imagen_quienes_somos_id');
}