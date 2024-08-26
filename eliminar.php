<?php
// Crear conexión
$conn = new mysqli("localhost", "root", "", "ficha_tecnica");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];

    // Usar una declaración preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM ficha WHERE usuario = $id");
    $stmt->bind_param("s", $usuario);

    if ($stmt->execute() === TRUE) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error eliminando el registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "El nombre de usuario no está definido.";
}

$conn->close();
?>
