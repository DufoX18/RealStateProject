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
                echo "<script>
                        alert('Error al mover el archivo.');
                        window.location.href = '../ingresarPropiedad.php';
                      </script>";
            }
        } else {
            echo "<script>
            alert('Tipo de archivo no permitido.');
            window.location.href = '../ingresarPropiedad.php';
          </script>";
        }
    } else {
        echo "<script>
        alert('El archuivo está vacio.');
        window.location.href = '../ingresarPropiedad.php';
      </script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

            $queryPropiedad = "INSERT INTO propiedades (tipo, destacada, titulo, descripcion, precio, agente_id, imagen_id) 
                               VALUES ('$tipo_propiedad', '$destacada', '$titulo', '$descripcion', '$precio', '$usuario_id', '$imagenID')";

            if (mysqli_query($conection, $queryPropiedad)) {
                echo "<script>
                        alert('Propiedad guardada exitosamente.');
                        window.location.href = '../ingresarPropiedad.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                alert('Error al guardar la propiedad.');
                window.location.href = '../ingresarPropiedad.php';
              </script>";            }
        } else {
            echo "<script>
            alert('Error al guardar la imagen.');
            window.location.href = '../ingresarPropiedad.php';
          </script>";        }
    }
}

mysqli_close($conection);
