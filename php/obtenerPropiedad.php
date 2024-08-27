<?php
include 'conexion.php';

$agente_id = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : '';
$propiedad_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($propiedad_id > 0 && $agente_id > 0) {
    $sql = "SELECT p.id, p.tipo, p.destacada, p.titulo, p.descripcion, p.precio, i.nombre AS imagen
            FROM propiedades p
            LEFT JOIN imagenes i ON p.imagen_id = i.id
            WHERE p.agente_id = $agente_id AND p.id = $propiedad_id";
    $result = mysqli_query($conection, $sql);

    if ($result) {
        $propiedad = mysqli_fetch_assoc($result);
    } else {
        echo "Error al obtener los datos: " . mysqli_error($conection);
    }

    mysqli_close($conection);
} else {
    echo "No se ha proporcionado un ID de propiedad válido.";
}
?>

