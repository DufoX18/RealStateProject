<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$db = "inmobiliaria";

$conection = mysqli_connect($servidor, $usuario, $pass, $db);
$revision = mysqli_query($conection, "SET NAMES 'utf8'");

if (mysqli_connect_errno()) {
    echo "Problemas a la hora de conectarse: " . mysqli_connect_error();
    exit();
}
