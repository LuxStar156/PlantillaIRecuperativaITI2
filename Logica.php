<?php

use PHPMailer\PHPMailer\PHPMailer;

// Obtener los datos del formulario
$destinatario = $_POST['correo'];
$asunto = "Este mensaje es para ti";
$mensaje = "Hola, este es un mensaje de prueba.";

// Configuración de la base de datos
$servername = "localhost";
$username = "lu";
$password = "1234";
$dbname = "ITI2";


// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Función para enviar correos y guardarlos en la base de datos



function enviarCorreo($destinatario, $asunto, $mensaje) {
    global $conn;

    // Enviar el correo
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor de correo
        $mail->isSMTP();
        $mail->Host = 'luciano.poblete@virginiogomez.cl';
        $mail->SMTPAuth = true;
        $mail->Username = 'luciano.poblete@virginiogomez.cl';
        $mail->Password = 'Hola.1560';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('luciano.poblete@virginiogomez.cl', 'Luciano Poblete');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
   
        $mail->send();
        echo "Correo enviado correctamente.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: " . $mail->ErrorInfo;
    }
   

    // Guardar el correo en la base de datos
    $sql = "INSERT INTO mensaje (mail, mensaje) VALUES ('$destinatario','$mensaje')";
    if ($conn->query($sql) === TRUE) {
        echo "Correo enviado y guardado en la base de datos correctamente.";
    } else {
        echo "Error al enviar y guardar el correo: " . $conn->error;
    }
}

// Llamar a la función para enviar el correo
enviarCorreo($destinatario, $asunto, $mensaje);

// Cerrar la conexión a la base de datos
$conn->close();
//header('location index.php');
?>
