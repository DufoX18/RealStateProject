<?php
include_once 'conexion.php';
include 'session.php';

function subirImagen($fileInput)
{
    $directorioRelativo = "./assets/img/";
    $archivoRelativo = $directorioRelativo . basename($_FILES[$fileInput]["name"]);
    $directorioAbsoluto = "../assets/img/";
    $archivoAbsoluto = $directorioAbsoluto . basename($_FILES[$fileInput]["name"]);
    $tipoArchivo = strtolower(pathinfo($archivoAbsoluto, PATHINFO_EXTENSION));

    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['size'] > 0) {
        if (in_array($tipoArchivo, ["jpg", "jpeg", "png", "gif", "webp"])) {
            if (move_uploaded_file($_FILES[$fileInput]["tmp_name"], $archivoAbsoluto)) {
                return $archivoRelativo;
            } else {
                echo "Error al mover el archivo a $archivoAbsoluto";
            }
        } else {
            echo "Tipo de archivo no permitido.";
        }
    } else {
        echo "No se ha subido ningún archivo o el archivo está vacío.";
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad_id = mysqli_real_escape_string($conection, $_POST['update_propiedad_id']);
    $tipo_propiedad = mysqli_real_escape_string($conection, $_POST['tipo_propiedad']);
    $destacada = mysqli_real_escape_string($conection, $_POST['destacada']);
    $titulo = mysqli_real_escape_string($conection, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conection, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conection, $_POST['precio']);

    $usuario_id  = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : '';

    $imagenRuta = subirImagen('imagen');

    if ($imagenRuta) {
        $queryImagen = "INSERT INTO imagenes (nombre, direccion) VALUES ('" . basename($imagenRuta) . "', '" . $imagenRuta . "')";

        if (mysqli_query($conection, $queryImagen)) {
            $imagenID = mysqli_insert_id($conection);

            $queryPropiedad = "UPDATE propiedades SET tipo = '$tipo_propiedad', destacada = '$destacada', titulo = '$titulo', descripcion = '$descripcion', precio = '$precio', agente_id = '$usuario_id', imagen_id = '$imagenID' WHERE id = '$propiedad_id'";

            if (mysqli_query($conection, $queryPropiedad)) {
                header('Location: ../actualizarPropiedad.php?id=' . $propiedad_id);
            } else {
                echo "Error al actualizar la propiedad: " . mysqli_error($conection);
            }
        } else {
            echo "Error al guardar la imagen: " . mysqli_error($conection);
        }
    } else {
        $queryPropiedad = "UPDATE propiedades SET tipo = '$tipo_propiedad', destacada = '$destacada', titulo = '$titulo', descripcion = '$descripcion', precio = '$precio', agente_id = '$usuario_id' WHERE id = '$propiedad_id'";

        if (mysqli_query($conection, $queryPropiedad)) {
            header('Location: ../actualizarPropiedad.php?id=' . $propiedad_id);
        } else {
            echo "Error al actualizar la propiedad: " . mysqli_error($conection);
        }
    }
}
