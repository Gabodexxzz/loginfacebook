<?php
// Configuración de conexión a la base de datos
$host = 'sql213.infinityfree.com'; 
$username = 'if0_36904110'; // Nombre de usuario de la base de datos
$password = 'RcD7kvxRiaBun'; // Contraseña de la base de datos
$database = 'if0_36904110_accesos'; // Nombre de la base de datos

// Establecer conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado, verificar contraseña
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Inicio de sesión exitoso, redireccionar o mostrar página principal
            echo "Inicio de sesión exitoso. Bienvenido, " . $username;
            // Aquí podrías redirigir a la página principal
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
    }
}

// Cerrar conexión
$conn->close();

