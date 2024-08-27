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
                    <h2 class="text-center">Ingresar Propiedad</h2>
                    <form action="php/logicaIngresarPropiedad.php" method="POST" enctype="multipart/form-data" class="mt-4" id="personalizar">

                        <div class="mb-3">
                            <label for="color_tema" class="form-label">Tipo de Propiedad</label>
                            <select class="form-select" name="tipo_propiedad" id="color_tema" required>
                                <option value="Alquiler">Alquiler</option>
                                <option value="Venta">Venta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destacada" class="form-label">Destacada</label>
                            <select class="form-select" name="destacada" id="destacada" required>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precio" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-custom">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>