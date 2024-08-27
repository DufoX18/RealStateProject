<?php
$query = '';
if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conection, $_GET['query']);
}

$resultados = [];
if ($query) {
    $sql = "SELECT propiedades.titulo, propiedades.descripcion, propiedades.tipo, propiedades.precio, imagenes.direccion AS imagen, usuarios.nombre AS nombre_usuario, usuarios.telefono AS telefono_usuario
            FROM propiedades 
            INNER JOIN imagenes ON propiedades.imagen_id = imagenes.id
            INNER JOIN usuarios ON propiedades.agente_id = usuarios.id
            WHERE propiedades.descripcion LIKE '%$query%'";

    $result = mysqli_query($conection, $sql);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conection));
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultados[] = $row;
        }
    }
}
