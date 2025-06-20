<?php
session_start();

if (isset($_SESSION['id_usuario'])) {
    try {
        $base = new PDO("mysql:host=localhost; dbname=inventario", "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_usuario = $_SESSION['id_usuario'];
        $nombre_usuario = $_SESSION['usuario'];

        $sql = "SELECT rolUsuario FROM usuarios WHERE idUsuario = :id";
        $resultado = $base->prepare($sql);
        $resultado->bindValue(":id", $id_usuario);
        $resultado->execute();

        $row = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $rol = $row['rolUsuario'];

            if ($rol == 1) {
                echo "El usuario es un administrador.<br>";
                echo "Usuario que inició sesión: " . $nombre_usuario;
            } elseif ($rol == 2) {
                echo "El usuario es normal.";
            } elseif ($rol == 3) {
                echo "Usuario lector.";
            } else {
                echo "Rol desconocido.";
            }
        } else {
            echo "No se encontró información para el usuario con ID: $id_usuario";
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "ID de usuario no disponible en la sesión.";
}
?>
