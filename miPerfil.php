<?php 
include_once 'php/mostrar.php';
include './php/session.php';
include_once './php/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$query = "SELECT nombre, telefono, correo, usuario FROM usuarios WHERE id = '$usuario_id'";
$result = mysqli_query($conection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $propiedad = mysqli_fetch_assoc($result);
} else {
    echo "No se encontraron datos del usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
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
                    <h2 class="text-center">Actualizar mis datos</h2>
                    <form action="php/actualizarPerfil.php" method="POST" enctype="multipart/form-data" class="mt-4" id="personalizar">
                        <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($propiedad['nombre']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="<?= htmlspecialchars($propiedad['telefono']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo" id="correo" value="<?= htmlspecialchars($propiedad['correo']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" value="<?= htmlspecialchars($propiedad['usuario']) ?>">
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
