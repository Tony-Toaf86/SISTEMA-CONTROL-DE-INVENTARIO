<?php
session_start();
require_once "../Database.php";

// Sanitize and validate inputs
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];
$cfpassword = $_POST['cfpassword'];
$name = $_POST['name'];

// Check if all required fields are filled
if (empty($username) || empty($password) || empty($name) || empty($cfpassword)) {
    echo "<script>alert('Por favor complete todos los campos.');</script>";
    header("Refresh:0, url=member.html");
    exit();
}

// Check if passwords match
if ($password !== $cfpassword) {
    echo "<script>alert('Las contraseñas no coinciden.');</script>";
    header("Refresh:0, url=member.html");
    exit();
}

// Hash password securely (use password_hash for better security)
$password_hashed = md5($password); // Consider using password_hash() for better security

// Check if the username already exists
$sql = "SELECT username FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('El usuario ya está en uso.');</script>";
    header("Refresh:0, url=member.html");
    exit();
} else {
    // Insert new user into the database
    $sql = "INSERT INTO user (username, password, name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password_hashed, $name);

    if ($stmt->execute()) {
        echo "<script>alert('Registro completado exitosamente.');</script>";
        header("Refresh:0, url=../index.html");
        exit();
    } else {
        echo "<script>alert('Hubo un error en el registro.');</script>";
        header("Refresh:0, url=member.html");
        exit();
    }
}

mysqli_close($conn);
?>
