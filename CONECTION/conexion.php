<?php
try {
    $base = new PDO("mysql:host=localhost; dbname=inventario", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM usuarios WHERE nombre = :login AND Contraseña = :password";

    $resultado = $base->prepare($sql);

    $login = htmlentities(addslashes($_POST["usuario"]));
    $password = htmlentities(addslashes($_POST["password"]));

    $resultado->bindValue(":login", $login);
    $resultado->bindValue(":password", $password);

    $resultado->execute();

    $numero_registro = $resultado->rowCount();

    if ($numero_registro != 0) {
        session_start();
        $row = $resultado->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_usuario'] = $row['ID'];
        $_SESSION['usuario'] =$row['Nombre']; //si se quiere evaluar otra solo copiar

        header("Location: verificando_usuario.php");
    } else {
        echo "No se inició sesión";
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
