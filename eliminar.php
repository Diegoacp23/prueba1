<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ficha_tecnica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM telecomunicaciones WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
