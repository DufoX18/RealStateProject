<?php
include './php/session.php';
include './php/conexion.php';

if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
$nombreUsuario = isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre'] : '';
?>
<style>
    .nav-link {
        font-size: 15px;
    }

    /* Para cuando llegue a resolución móvil que las lineas del menú desplegable se hagan blancas (conocimiento adquirido) */
    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"%3E%3Cpath stroke="%23fff" stroke-width="2" d="M5 7h20M5 15h20M5 23h20" /%3E%3C/svg%3E');
    }
</style>

<nav class="navbar navbar-expand-lg" style="background-color:<?php mostrarColor1() ?>;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="<?php mostrarIconoPrincipal() ?>" alt="UTN Solutions Real Estate" class="ms-2" width="80" height="70px">
            <?php if (isset($_SESSION['usuario'])) : ?>
                <span class="nav-link text-light ms-4">
                    Hola <i class="bi bi-hand-thumbs-up"></i>, <?php echo htmlspecialchars($nombreUsuario); ?>
                </span>
            <?php endif; ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (isset($_SESSION['usuario'])) : ?>
                <?php
                $privilegio = $_SESSION['usuario']['privilegio'];
                ?>
                <ul class="navbar-nav ms-auto list">
                    <?php if ($privilegio == 'administrador') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./personalizar.php">PERSONALIZAR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./roles.php">ROLES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./miPerfil.php">MI PERFIL</a>
                        </li>
                    <?php elseif ($privilegio == 'agente_de_ventas') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./misPropiedades.php">MIS PROPIEDADES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ingresarPropiedad.php">NUEVA PROPIEDAD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./miPerfil.php">MI PERFIL</a>
                        </li>
                    <?php elseif ($privilegio == 'publico') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="destacadas.php">DESTACADAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./ventas.php">VENTAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./alquiler.php">ALQUILERES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./miPerfil.php">MI PERFIL</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex" method="GET" action="propiedadBuscada.php">
                    <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <br>
                <form class="d-inline ms-2" method="post">
                    <button class="btn btn-outline-light" type="submit" name="logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            <?php else : ?>
                <ul class="navbar-nav ms-auto list">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destacadas">DESTACADAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ventas">VENTAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#alquileres">ALQUILERES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">CONTACTENOS</a>
                    </li>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <br>
                    <li class="nav-item">
                        <form class="d-inline" method="post" style="margin-left:7px">
                            <button class="btn btn-outline-light" type="submit" name="redirect"><i class="bi bi-person"></i></button>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
    header("Location: login.php");
    exit();
}
?>