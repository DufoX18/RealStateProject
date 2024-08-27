<?php include_once 'php/mostrar.php';
include './php/session.php';
if (!isset($_SESSION['usuario'])) {
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: login.php");
    exit();
}
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
    <link rel="stylesheet" href="./style/personalizar.css">
</head>

<body>
    <?php include_once './assets/include/navbar.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-dark custom-card">
                    <h2 class="text-center">Personalizar Sitio Web</h2>
                    <form action="php/logicaPersonalizar.php" method="POST" enctype="multipart/form-data" class="mt-4" id="personalizar">

                        <div class="mb-3">
                            <label for="color_tema" class="form-label">Color primario:</label>
                            <input type="color" class="form-control" name="color_1" id="color_1" value="<?php mostrarColor1(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="color_tema" class="form-label">Color secundario:</label>
                            <input type="color" class="form-control" name="color_2" id="color_2" value="<?php mostrarColor2(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="color_tema" class="form-label">Color terciario:</label>
                            <input type="color" class="form-control" name="color_3" id="color_3" value="<?php mostrarColor3(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="icono_principal" class="form-label">Ícono Principal:</label>
                            <input type="file" class="form-control" name="icono_principal" id="icono_principal">
                            <br>
                            <p>Ícono principal actual: <img src="<?php mostrarIconoPrincipal(); ?>" alt="Icono Principal" style="max-width: 100px;"></p>
                        </div>

                        <div class="mb-3">
                            <label for="imagen_banner" class="form-label">Imagen del Banner:</label>
                            <input type="file" class="form-control" name="imagen_banner" id="imagen_banner">
                            <br>
                            <p>Imagen del banner actual: <img src="<?php mostrarImagenBanner(); ?>" alt="Imagen del Banner" style="max-width: 100px;"></p>
                        </div>

                        <div class="mb-3">
                            <label for="mensaje_banner" class="form-label">Mensaje del Banner:</label>
                            <input type="text" class="form-control" name="mensaje_banner" id="mensaje_banner" value="<?php mostrarMensajeBanner(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="informacion_quienes_somos" class="form-label">Información "Quienes Somos":</label>
                            <textarea class="form-control" name="informacion_quienes_somos" id="informacion_quienes_somos" rows="3" required><?php mostrarInformacionQuienesSomos(); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="imagen_quienes_somos" class="form-label">Imagen "Quienes Somos":</label>
                            <input type="file" class="form-control" name="imagen_quienes_somos" id="imagen_quienes_somos">
                            <br>
                            <p>Imagen quienes somos actual: <img src="<?php mostrarImagenQuienesSomos(); ?>" alt="Imagen Quienes Somos" style="max-width: 100px;"></p>
                        </div>

                        <div class="mb-3">
                            <label for="enlace_facebook" class="form-label">Enlace Facebook:</label>
                            <input type="text" class="form-control" name="enlace_facebook" id="enlace_facebook" value="<?php mostrarEnlaceFacebook(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="enlace_youtube" class="form-label">Enlace YouTube:</label>
                            <input type="text" class="form-control" name="enlace_youtube" id="enlace_youtube" value="<?php mostrarEnlaceYoutube(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="enlace_instagram" class="form-label">Enlace Instagram:</label>
                            <input type="text" class="form-control" name="enlace_instagram" id="enlace_instagram" value="<?php mostrarEnlaceInstagram(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php mostrarDireccion(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php mostrarTelefono(); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php mostrarEmail(); ?>" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-custom">Guardar Configuración</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>