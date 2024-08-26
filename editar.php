<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $nuevoValor = $_POST['nuevoValor'];

    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Actualizar el valor en la base de datos
    $sql = "UPDATE usuarios SET valor_columna = '$nuevoValor' WHERE usuario = '$usuario'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
