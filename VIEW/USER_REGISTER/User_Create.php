<?php 
// Conectar a la base de datos
$local = "localhost";
$db_usuario = "root";
$db_pass = "";
$db_nombre = "inventario";

$conexion = new mysqli($local, $db_usuario, $db_pass, $db_nombre);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$usuario = $_POST["usuario"];
$pass = $_POST["password"];
$valipass = $_POST["truepassword"];
$rolGeneral = 1; // rol por defecto

// Validar que las contraseñas coincidan
if ($pass !== $valipass) {
    die("Error: Las contraseñas no coinciden.");
}

// Codificar la contraseña
$passHash = password_hash($pass, PASSWORD_DEFAULT);

// Preparar la consulta para evitar inyecciones SQL
$stmt = $conexion->prepare(query: "INSERT INTO usuarios (nombre, apellido, usuario, contrasena, rolUsuario) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $nombre, $apellido, $usuario, $passHash, $rolGeneral);

// Ejecutar y verificar
if ($stmt->execute()) {
    echo "Usuario registrado correctamente.";
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

// Cerrar
$stmt->close();
$conexion->close();
?>
