<?php
session_start();
require_once "Database.php";

if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    echo "<script>alert('Por favor inicie sesión.');</script>";
    header("Refresh:0; url=index.html");
    exit();
}

$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
?>
<!doctype html>
<html lang="es">
<head>
    <title>Lista de Productos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="faviconconfiguroweb.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #fd7e1b;
            margin: 0;
            padding: 0;
        }
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background-color: #298dba;
            color: white;
            padding: 10px 20px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
            z-index: 1000;
        }
        .header h3 {
            float: left;
            margin: 0;
            line-height: 40px;
        }
        .button-logout {
            float: right;
            background-color: #e60000;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 10px;
            margin-top: 5px;
            transition: 0.3s;
        }
        .button-logout:hover {
            background-color: #ff6666;
            color: white;
        }
        .container {
            margin: 100px auto 20px auto;
            padding: 20px;
            width: 80%;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #298dba;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .bfix, .bdelete {
            padding: 5px 15px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
        }
        .bfix {
            background-color: #ffcc33;
            color: black;
        }
        .bfix:hover {
            background-color: #fdb515;
            color: white;
        }
        .bdelete {
            background-color: #e60000;
            color: white;
        }
        .bdelete:hover {
            background-color: #ff9999;
            color: black;
        }
        .Addlist {
            display: inline-block;
            margin-top: 20px;
            background-color: #00A600;
            color: white;
            padding: 10px 25px;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s;
        }
        .Addlist:hover {
            background-color: #BBFFBB;
            color: black;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Lista Productos By Tony Alonzo</h3>
        <a class="button-logout" href="logout.php">Cerrar Sesión</a>
    </div>

    <div class="container">
        <h1>Lista de Productos</h1>
        <table>
            <tr>
                <th>Orden</th>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
                <th>Fecha Registro</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php
            $idpro = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $idpro ?></td>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['proname'] ?></td>
                    <td><?php echo $row['amount'] ?></td>
                    <td><?php echo $row['time'] ?></td>
                    <td><a class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?>">Editar</a></td>
                    <td><a class="bdelete" href="main/delete.php?id=<?php echo $row['id'] ?>">Eliminar</a></td>
                </tr>
            <?php $idpro++; } ?>
        </table>

        <a class="Addlist" href="addlist.php">Agregar Producto</a>
    </div>
    <?php mysqli_close($conn); ?>
</body>
</html>
