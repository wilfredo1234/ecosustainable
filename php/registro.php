<?php
// Incluir el archivo de conexión
require 'connection.php';

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    try {
        // Generar el hash de la contraseña
        $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar un nuevo usuario en la tabla usuarios
        $sql = "INSERT INTO users (username, password, correo, fecha_nacimiento, edad, nombres, apellidos)
                VALUES (:username, :password, :correo, :fecha_nacimiento, :edad, :nombres, :apellidos)";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        
        // Asignar valores a los parámetros
        $stmt->bindParam(':username', $correo);
        $stmt->bindParam(':password', $contraseña_hasheada); // Usar la contraseña hasheada
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        
        // Ejecutar la consulta
        $stmt->execute();

        echo "Registro exitoso";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
