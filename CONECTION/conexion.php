<?php
try {
    $base = new PDO("mysql:host=localhost; dbname=inventario", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $login = htmlentities(addslashes($_POST["usuario"]));
        $password = htmlentities(addslashes($_POST["password"]));

        $sql = "SELECT * FROM usuarios WHERE usuario = :login";
        $resultado = $base->prepare($sql);
        $resultado->bindValue(":login", $login);
        $resultado->execute();

        $row = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['contrasena'])) {
            session_start();
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rolUsuario'] = $row['rolUsuario']; // ← AÑADIDO AQUÍ

            header("Location: verificando_usuario.php");
        } else {
            echo "No se inició sesión. Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Acceso no válido.";
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
