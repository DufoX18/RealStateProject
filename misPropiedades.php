<?php
include_once './php/conexion.php';
include './php/session.php';
include './php/mostrar.php';

if (!isset($_SESSION['usuario'])) {
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: login.php");
    exit();
}

$usuario_id = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : '';

$query = "SELECT propiedades.*, imagenes.direccion AS imagen_ruta 
          FROM propiedades 
          JOIN imagenes ON propiedades.imagen_id = imagenes.id 
          WHERE propiedades.agente_id = '$usuario_id'";

$resultado = mysqli_query($conection, $query);

$cantidad_propiedades = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Propiedades</title>
    <link rel="stylesheet" href="./style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./php/dynamic-styles.php">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: <?php mostrarColor2(); ?>; color: <?php mostrarColor1(); ?>;">
    <?php include_once './assets/include/navbar.php'; ?>
    <br>
    <div class="container">
        <h1 class="text-center mb-5">MIS PROPIEDADES</h1>

        <?php if ($cantidad_propiedades > 0): ?>
            <div class="row">
                <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
                    <div class="col-md-4 mb-5">
                        <div class="card" style="background-color: <?php mostrarColor1(); ?>;">
                            <img src="<?php echo $propiedad['imagen_ruta']; ?>" alt="<?php echo $propiedad['titulo']; ?>">
                            <div class="card-body">
                                <h5 class="card-title text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['titulo']; ?></h5>
                                <p class="card-text text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['descripcion']; ?></p>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">
                                    Tipo: <?php echo ucfirst($propiedad['tipo']); ?>
                                </p>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">
                                    Destacada: <?php echo $propiedad['destacada'] == 1 ? 'Sí' : 'No'; ?>
                                </p>
                                <?php if ($propiedad['tipo'] == 'venta') : ?>
                                    <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio: $<?php echo number_format($propiedad['precio']); ?></p>
                                <?php elseif ($propiedad['tipo'] == 'alquiler') : ?>
                                    <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio mensual: $<?php echo number_format($propiedad['precio']); ?></p>
                                <?php endif; ?>
                                <div style="text-align: end;">
                                    <form id="updateForm" action="./php/obtenerPropiedad.php" method="POST" class="d-inline">
                                        <input type="hidden" name="update_propiedad_id" value="<?php echo htmlspecialchars($propiedad['id']); ?>">
                                        <a href="actualizarPropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </form>
                                    <form id="deleteForm" action="./php/eliminarPropiedad.php" method="POST" class="d-inline">
                                        <input type="hidden" name="delete_propiedad_id" id="delete_propiedad_id" value="">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-propiedad-id="<?php echo $propiedad['id']; ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <h3 class="text-center">No tienes propiedades creadas.</h3>
        <?php endif; ?>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta propiedad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-bs-target="#confirmDeleteModal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                var propiedadId = button.getAttribute('data-propiedad-id');
                document.getElementById('delete_propiedad_id').value = propiedadId;
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            document.getElementById('deleteForm').submit();
        });
    </script>
</body>

</html>

<?php
mysqli_close($conection);
?>