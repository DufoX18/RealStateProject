<?php include_once 'php/mostrar.php';
include './php/session.php';
include_once 'php/obtenerPropiedad.php';
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
                    <h2 class="text-center">Actualizar Propiedad</h2>
                    <form action="php/actualizarPropiedad.php" method="POST" enctype="multipart/form-data" class="mt-4" id="personalizar">
                        <input type="hidden" name="update_propiedad_id" value="<?php echo htmlspecialchars($propiedad['id']); ?>">
                        <div class="mb-3">
                            <label for="color_tema" class="form-label">Tipo de Propiedad</label>
                            <select class="form-select" name="tipo_propiedad" id="color_tema">
                                <option value="Alquiler" <?= $propiedad['tipo'] == 'alquiler' ? 'selected' : '' ?>>Alquiler</option>
                                <option value="Venta" <?= $propiedad['tipo'] == 'venta' ? 'selected' : '' ?>>Venta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destacada" class="form-label">Destacada</label>
                            <select class="form-select" name="destacada" id="destacada">
                                <option value="0" <?= $propiedad['destacada'] == 0 ? 'selected' : '' ?>>No</option>
                                <option value="1" <?= $propiedad['destacada'] == 1 ? 'selected' : '' ?>>Si</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" value="<?= htmlspecialchars($propiedad['titulo']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?= htmlspecialchars($propiedad['descripcion']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precio" value="<?= htmlspecialchars($propiedad['precio']) ?>" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <?php if (!empty($propiedad['imagen'])): ?>
                                <p class="mt-4">Imagen actual:</p>
                                <img src="./assets/img/<?= htmlspecialchars($propiedad['imagen']) ?>" alt="Imagen de la propiedad" width="200">
                            <?php endif; ?>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-custom">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>