<?php
session_start(); // Asegurarse de iniciar la sesión

// Incluir el archivo de configuración de la base de datos
include('connection.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    die("Usuario no autenticado.");
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen1 = $_FILES['imagen1']['name'];
    $imagen2 = $_FILES['imagen2']['name'];
    $imagen3 = $_FILES['imagen3']['name'];
    
    // Ruta para almacenar las imágenes
    $target_dir = "../uploads/";
    $target_file1 = $target_dir . basename($_FILES["imagen1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["imagen2"]["name"]);
    $target_file3 = $target_dir . basename($_FILES["imagen3"]["name"]);
    
    // Mover los archivos subidos a la carpeta destino
    move_uploaded_file($_FILES["imagen1"]["tmp_name"], $target_file1);
    move_uploaded_file($_FILES["imagen2"]["tmp_name"], $target_file2);
    move_uploaded_file($_FILES["imagen3"]["tmp_name"], $target_file3);

    // Obtener el ID del usuario desde la sesión
    $username = $_SESSION['username'];
    $sql_user = "SELECT id FROM users WHERE username = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->execute([$username]);
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
    $usuario_id = $user['id'];

    // Preparar la consulta SQL para insertar un nuevo producto
    $sql = "INSERT INTO productos (nombre, descripcion, imagen1, imagen2, imagen3, usuario_id)
            VALUES (:nombre, :descripcion, :imagen1, :imagen2, :imagen3, :usuario_id)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':imagen1', $imagen1);
        $stmt->bindParam(':imagen2', $imagen2);
        $stmt->bindParam(':imagen3', $imagen3);
        $stmt->bindParam(':usuario_id', $usuario_id);
        
        $stmt->execute();
        echo "Producto subido exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // Cerrar la conexión
    $conn = null;
}
?>
