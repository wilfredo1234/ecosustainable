<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: ../html/index.html');
    exit();
}

// Incluir el archivo de configuración de la base de datos
include('connection.php');

// Obtener todos los productos y el número de teléfono del usuario que los publicó
$sql = "SELECT p.*, u.numero_telefono FROM productos p JOIN users u ON p.usuario_id = u.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los productos en formato JSON
echo json_encode($productos);
?>
