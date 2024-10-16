<?php
// Iniciar sesión
session_start();

// Incluir el archivo de configuración de la base de datos
include('connection.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Crear una consulta SQL para verificar el usuario
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]); // Utilizando un array para pasar los parámetros
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un usuario
    if ($user) {
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Iniciar sesión exitosa
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header('Location: ../html/home.html');
            exit();
        } else {
            // Contraseña incorrecta
            echo "Nombre de usuario o contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "Nombre de usuario o contraseña incorrecta.";
    }
}
?>

