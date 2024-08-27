<?php
include_once 'php/conexion.php';

$query = "SELECT propiedades.titulo, propiedades.descripcion, propiedades.precio, imagenes.direccion AS imagen, usuarios.nombre AS nombre_usuario, usuarios.telefono AS telefono_usuario
    FROM propiedades 
    INNER JOIN imagenes ON propiedades.imagen_id = imagenes.id
    INNER JOIN usuarios ON propiedades.agente_id = usuarios.id
    WHERE propiedades.tipo = 'venta'
    ORDER BY propiedades.fecha_creacion DESC
    LIMIT 3";

$resultado = mysqli_query($conection, $query);
?>