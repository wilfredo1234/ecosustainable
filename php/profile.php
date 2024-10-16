<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: ../html/index.html');
    exit();
}

// Incluir el archivo de configuración de la base de datos
include('connection.php');

// Obtener la información del usuario
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener los productos del usuario
$sql = "SELECT * FROM productos WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user['id']]);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los datos del usuario y sus productos en formato JSON
echo json_encode(['user' => $user, 'productos' => $productos]);
?>
