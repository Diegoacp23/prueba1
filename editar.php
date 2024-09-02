<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'ficha_tecnica');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $id = $_POST['id'];
    $fecha = $_POST['Fecha'];
    $GT = $_POST['GT'];
    // Obtén los demás campos del formulario

    // Actualizar los datos en la base de datos
    $sql = "UPDATE telecomunicaciones SET Fecha='$fecha' WHERE id='$id'";
    // Agrega los demás campos a la consulta SQL

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }

    $conn->close();
}
?>
