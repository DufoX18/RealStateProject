<?php
include './php/session.php';
include './php/mostrar.php';
include './php/conexion.php';
include './php/buscador.php';

if (!isset($_SESSION['usuario'])) {
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades Buscadas</title>
    <link rel="stylesheet" href="./style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./php/dynamic-styles.php">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="./style/personalizar.css">
</head>

<body>
    <?php include_once './assets/include/navbar.php'; ?>
    <br>
    <div class="container">
        <h1 class="text-center mb-5">PROPIEDADES BUSCADAS</h1>
        <div class="row">
            <?php if (!empty($resultados)): ?>
                <?php foreach ($resultados as $propiedad): ?>
                    <div class="col-md-4 mb-5">
                        <div class="card" style="background-color: <?php mostrarColor1(); ?>;">
                            <img src="<?php echo $propiedad['imagen']; ?>" alt="<?php echo $propiedad['titulo']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['titulo']; ?></h5>
                                <p class="card-text text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['descripcion']; ?></p>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Tipo: <?php echo ($propiedad['tipo']); ?></p>
                                <?php if ($propiedad['tipo'] == 'venta') : ?>
                                    <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio: $<?php echo number_format($propiedad['precio']); ?></p>
                                <?php elseif ($propiedad['tipo'] == 'alquiler') : ?>
                                    <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio mensual: $<?php echo number_format($propiedad['precio']); ?></p>
                                <?php endif; ?> <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Agente de ventas: <?php echo $propiedad['nombre_usuario']; ?></p>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Teléfono: <?php echo $propiedad['telefono_usuario']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center mt-4">No se encontró ninguna propiedad con la descripción ingresada.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>