<?php
// Obtener los datos del formulario
$destinatario = $_POST['correo'];
$asunto = "Este mensaje es para ti";
$mensaje = "Hola, este es un mensaje de prueba.";

echo "Funciona";
exit();

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "hola1234";
$dbname = "plantilla";

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
    // Aquí puedes agregar tu código para enviar el correo utilizando la función mail() u otra librería de envío de correos
    $headers = "From: tu_email@example.com" . "\r\n" .
               "Reply-To: tu_email@example.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Error al enviar el correo.";
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
?>