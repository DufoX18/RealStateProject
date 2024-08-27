<?php

include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $captcha = $_POST['g-recaptcha-response'];

    if (!$captcha) {
        echo "<script>alert('Por favor, verifica el captcha.');
            window.location.href = '../index.php';
         </script>";
        exit;
    }

    $secretKey = "6Le1oyIqAAAAAEavZfOETALlha9uMF6BpEA4cRem";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "<script>alert('Verificación de captcha fallida. Por favor, inténtalo de nuevo.');
            window.location.href = '../index.php';        
        </script>";
        exit;
    }

    if (isset($responseKeys["score"]) && $responseKeys["score"] < 0.5) {
        echo "<script>alert('La verificación del captcha indica un comportamiento sospechoso. Por favor, inténtalo de nuevo.');
        window.location.href = '../index.php';
        </script>";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'carodri323@gmail.com';
        $mail->Password   = 'zmahotgzoctwyrgj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('carodri323@gmail.com', 'Dufo');
        $mail->addAddress('carodri323@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $name;
        $mail->Body    = "<p>Correo: $email</p><p>Teléfono: $phone</p><p>Mensaje: $message</p>";

        if ($mail->send()) {
            $sql = "INSERT INTO mensajescontacto (nombre, correo, mensaje) VALUES ('$name', '$email', '$message')";

            if (mysqli_query($conection, $sql)) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Error al guardar los datos: " . mysqli_error($conection) . "');
                  window.location.href = '../index.php';
                </script>";
            }
        } else {
            echo "<script>alert('El correo no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}');
             window.location.href = '../index.php';
            </script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar el correo: " . $mail->ErrorInfo . "');
           window.location.href = '../index.php';
        </script>";
    }
}
