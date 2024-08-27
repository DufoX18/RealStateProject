<?php
require_once 'conexion.php';

$query = "SELECT * FROM usuarios";
$resultUsuarios = mysqli_query($conection, $query);

if (!$resultUsuarios) {
    die("Error en la consulta: " . mysqli_error($conection));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['user_id']) && isset($_POST['role_id'])) {
            $userId = intval($_POST['user_id']);
            $roleId = $_POST['role_id'];

            $query = "UPDATE usuarios SET privilegio = ? WHERE id = ?";
            $stmt = mysqli_prepare($conection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $roleId, $userId);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                    window.location.href = '../roles.php';
                </script>";
            } else {
                echo "<script>
                    alert('Hubo un error al actualizar el rol');
                    window.location.href = '../roles.php';
                </script>";
            }

            mysqli_stmt_close($stmt);
        }

        if (isset($_POST['delete_user_id'])) {
            $userId = intval($_POST['delete_user_id']);
            $query = "DELETE FROM usuarios WHERE id = ? AND privilegio != 'administrador'";
            $stmt = mysqli_prepare($conection, $query);
            mysqli_stmt_bind_param($stmt, 'i', $userId);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                    window.location.href = '../roles.php';
                </script>";
            } else {
                throw new mysqli_sql_exception('Error en la eliminación del usuario');
            }

            mysqli_stmt_close($stmt);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            echo "<script>
                alert('El usuario no puede ser eliminado porque tiene propiedades asignadas.');
                window.location.href = '../roles.php';
            </script>";
        } else {
            echo "<script>
                alert('Hubo un error: " . $e->getMessage() . "');
                window.location.href = '../roles.php';
            </script>";
        }
    }
}
