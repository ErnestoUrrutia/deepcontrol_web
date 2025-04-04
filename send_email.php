<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos del formulario
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Formato del contenido a guardar
    $data = "==============================\n";
    $data .= "Fecha: " . date("Y-m-d H:i:s") . "\n";
    $data .= "Nombre: $name\n";
    $data .= "Correo: $email\n";
    $data .= "Asunto: $subject\n";
    $data .= "Mensaje:\n$message\n";
    $data .= "==============================\n\n";

    // Ruta del archivo donde se guardarán los datos
    $file = "mensajes.txt";

    // Mostrar mensaje y redirigir
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Mensaje Enviado</title>
        <meta http-equiv='refresh' content='5;url=index.html'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f0f0;
                text-align: center;
                padding-top: 100px;
            }
            .mensaje {
                background: #fff;
                display: inline-block;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
        <div class='mensaje'>";
    
    if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX)) {
        echo "<h2>Mensaje guardado correctamente.</h2>";
    } else {
        echo "<h2>Hubo un error al guardar el mensaje.</h2>";
    }

    echo "<p>Serás redirigido al inicio en 5 segundos...</p>
        </div>
    </body>
    </html>";
} else {
    // Si alguien accede directamente sin usar el formulario
    header("Location: index.html");
    exit;
}
?>
