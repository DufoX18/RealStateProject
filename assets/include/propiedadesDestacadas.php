<?php
include_once './php/mostrarDestacados.php';
$totalPropiedades = mysqli_num_rows($resultado);
mysqli_data_seek($resultado, 0);
?>
<section class="featured-properties py-5" style="background-color: <?php mostrarColor1(); ?>; color: <?php mostrarColor2(); ?>;">
    <div class="container">
        <h2 class="text-center mb-5">PROPIEDADES DESTACADAS</h2>
        <div class="row">
            <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
                <div class="col-md-4">
                    <div class="card" style="background-color: <?php mostrarColor1(); ?>;">
                        <img src="<?php echo $propiedad['imagen']; ?>" alt="<?php echo $propiedad['titulo']; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['titulo']; ?></h5>
                            <p class="card-text text-center" style="color: <?php mostrarColor2(); ?>;"><?php echo $propiedad['descripcion']; ?></p>
                            <p class="text-center" style="color: <?php mostrarColor3(); ?>;">
                                Propiedad en <?php echo ucfirst($propiedad['tipo']); ?>
                            </p>
                            <?php if ($propiedad['tipo'] == 'venta') : ?>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio: $<?php echo number_format($propiedad['precio']); ?></p>
                            <?php elseif ($propiedad['tipo'] == 'alquiler') : ?>
                                <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Precio mensual: $<?php echo number_format($propiedad['precio']); ?></p>
                            <?php endif; ?>
                            <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Agente de ventas: <?php echo $propiedad['nombre_usuario']; ?></p>
                            <p class="text-center" style="color: <?php mostrarColor3(); ?>;">Teléfono: <?php echo $propiedad['telefono_usuario']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php if ($totalPropiedades >= 3) : ?>
                <div class="d-flex justify-content-center mt-5">
                    <a href="./destacadas.php" class="btn" id="vermas" style="background-color: white; border-color: <?php mostrarColor1(); ?>; color: <?php mostrarColor1(); ?>;">
                        VER MÁS...
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>