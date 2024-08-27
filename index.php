<?php
include_once 'php/mostrar.php';
?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Real Estate</title>
    <link rel="stylesheet" href="./style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./php/dynamic-styles.php">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <?php include_once './assets/include/navbar.php'; ?>
    <?php include_once './assets/include/heroSection.php'; ?>
    <div id="quienesSomos">
        <?php include_once './assets/include/quienesSomos.php'; ?>
    </div>
    <div id="destacadas">
        <?php include_once './assets/include/propiedadesDestacadas.php'; ?>
    </div>
    <div id="ventas">
        <?php include_once './assets/include/propiedadesVenta.php'; ?>
    </div>
    <div id="alquileres">
        <?php include_once './assets/include/propiedadesAlquiler.php'; ?>
    </div>
    <div id="footer">
        <?php include_once './assets/include/footer.php'; ?>
    </div>
</body>

</html>