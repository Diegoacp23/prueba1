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

// Obtener datos del formulario con verificación
$fecha = isset($_POST['Fecha']) ? $_POST['Fecha'] : '';
$gt = isset($_POST['GT']) ? $_POST['GT'] : '';
$uni = isset($_POST['Uni']) ? $_POST['Uni'] : '';
$piso = isset($_POST['Piso']) ? $_POST['Piso'] : '';
$oficina = isset($_POST['Oficina']) ? $_POST['Oficina'] : '';
$cant_equipos = isset($_POST['CantEquipos']) ? $_POST['CantEquipos'] : '';
$mant_hardware = isset($_POST['MantHardware']) ? $_POST['MantHardware'] : '';
$mant_software = isset($_POST['MantSoftware']) ? $_POST['MantSoftware'] : '';
$data_center = isset($_POST['DataCenter']) ? $_POST['DataCenter'] : '';
$estatus = isset($_POST['Estatus']) ? $_POST['Estatus'] : '';
$core = isset($_POST['Core']) ? $_POST['Core'] : '';
$observacion = isset($_POST['Observacion']) ? $_POST['Observacion'] : '';

// Verificar si el registro ya existe
$check_sql = "SELECT * FROM telecomunicaciones WHERE Fecha='$fecha' AND GT='$gt' AND Uni='$uni' AND Piso='$piso' AND Oficina='$oficina'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "El registro ya existe.";
} else {
    // Preparar y ejecutar la consulta SQL de forma segura
    $stmt = $conn->prepare("INSERT INTO telecomunicaciones (Fecha, GT, Uni, Piso, Oficina, CantEquipos, MantHardware, MantSoftware, DataCenter, Estatus, Core, Observacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $fecha, $gt, $uni, $piso, $oficina, $cant_equipos, $mant_hardware, $mant_software, $data_center, $estatus, $core, $observacion);

    if ($stmt->execute()) {
        echo "Nuevo registro creado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Obtener todos los registros
$all_sql = "SELECT * FROM telecomunicaciones";
$all_result = $conn->query($all_sql);

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Formulario</title>
    <style>
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Encabezado de la Página</h1>
    </div>
    <a href="javascript:history.back()" class="back-button">Volver</a>
    <a href="generar_pdf.php" target="_blank">Imprimir PDF</a>
    <div class="table-container">
        <table>
            <tr>
                <th>Fecha</th>
                <th>Grupo de Trabajo</th>
                <th>Unidad</th>
                <th>Piso</th>
                <th>Ente u Oficina</th>
                <th>Can. de Equipos</th>
                <th>Mant. Hardware</th>
                <th>Mant. Software</th>
                <th>Data Center</th>
                <th>Estatus</th>
                <th>Puertos Switch</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($all_result->num_rows > 0) {
                while($row = $all_result->fetch_assoc()) {
                    echo "<tr id='row-{$row['id']}'>";
                    echo "<td>" . htmlspecialchars($row['Fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['GT']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Uni']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Piso']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Oficina']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['CantEquipos']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['MantHardware']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['MantSoftware']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DataCenter']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Estatus']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Core']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Observacion']) . "</td>";
                    echo "<td>";
                    echo "<button onclick=\"mostrarFormularioEdicion(" . htmlspecialchars(json_encode($row)) . ")\">Editar</button> | ";
                    echo "<button onclick=\"eliminarRegistro(" . $row['id'] . ")\">Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No hay registros</td></tr>";
            }
            ?>
        </table>
    </div>

    <div id="editarFormContainer" class="hidden">
        <h2>Editar Registro</h2>
        <form id="editarForm" onsubmit="actualizarRegistro(event)">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-fecha">Fecha:</label>
            <input type="text" id="edit-fecha" name="Fecha"><br>
            <label for="edit-gt">Grupo de Trabajo:</label>
            <input type="text" id="edit-gt" name="GT"><br>
            <label for="edit-uni">Unidad:</label>
            <input type="text" id="edit-uni" name="Uni"><br>
            <label for="edit-piso">Piso:</label>
            <input type="text" id="edit-piso" name="Piso"><br>
            <label for="edit-oficina">Ente u Oficina:</label>
            <input type="text" id="edit-oficina" name="Oficina"><br>
            <label for="edit-cant-equipos">Can. de Equipos:</label>
            <input type="text" id="edit-cant-equipos" name="CantEquipos"><br>
            <label for="edit-mant-hardware">Mant. Hardware:</label>
            <input type="text" id="edit-mant-hardware" name="MantHardware"><br>
            <label for="edit-mant-software">Mant. Software:</label>
            <input type="text" id="edit-mant-software" name="MantSoftware"><br>
            <label for="edit-data-center">Data Center:</label>
            <input type="text" id="edit-data-center" name="DataCenter"><br>
            <label for="edit-estatus">Estatus:</label>
            <input type="text" id="edit-estatus" name="Estatus"><br>
            <label for="edit-core">Puertos Switch:</label>
            <input type="text" id="edit-core" name="Core"><br>
            <label for="edit-observacion">Observación:</label>
            <input type="text" id="edit-observacion" name="Observacion"><br>
            <button type="submit">Actualizar</button>
        </form>
    </div>

    <script>
        function mostrarFormularioEdicion(rowData) {
            document.getElementById('edit-id').value = rowData.id;
            document.getElementById('edit-fecha').value = rowData.Fecha;
            document.getElementById('edit-gt').value = rowData.GT;
            document.getElementById('edit-uni').value = rowData.Uni;
            document.getElementById('edit-piso').value = rowData.Piso;
            document.getElementById('edit-oficina').value = rowData.Oficina;
            document.getElementById('edit-cant-equipos').value = rowData.CantEquipos;
            document.getElementById('edit-mant-hardware').value = rowData.MantHardware;
            document.getElementById('edit-mant-software').value = rowData.MantSoftware;
            document.getElementById('edit-data-center').value = rowData.DataCenter;
            document.getElementById('edit-estatus').value = rowData.Estatus;
            document.getElementById('edit-core').value = rowData.Core;
            document.getElementById('edit-observacion').value = rowData.Observacion;
            document.getElementById('editarFormContainer').classList.remove('hidden');
        }

        function actualizarRegistro(event) {
            event.preventDefault(); // Evitar el envío del formulario

            var formData = new FormData(document.getElementById("editarForm"));

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "editar.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    // Actualizar la tabla sin recargar la página
                    var rowId = formData.get('id');
                    document.querySelector(`#row-${rowId} td:nth-child(1)`).innerText = formData.get('Fecha');
                    document.querySelector(`#row-${rowId} td:nth-child(2)`).innerText = formData.get('GT');
                    document.querySelector(`#row-${rowId} td:nth-child(3)`).innerText = formData.get('Uni');
                    document.querySelector(`#row-${rowId} td:nth-child(4)`).innerText = formData.get('Piso');
                    document.querySelector(`#row-${rowId} td:nth-child(5)`).innerText = formData.get('Oficina');
                    document.querySelector(`#row-${rowId} td:nth-child(6)`).innerText = formData.get('CantEquipos');
                    document.querySelector(`#row-${rowId} td:nth-child(7)`).innerText = formData.get('MantHardware');
                    document.querySelector(`#row-${rowId} td:nth-child(8)`).innerText = formData.get('MantSoftware');
                    document.querySelector(`#row-${rowId} td:nth-child(9)`).innerText = formData.get('DataCenter');
                    document.querySelector(`#row-${rowId} td:nth-child(10)`).innerText = formData.get('Estatus');
                    document.querySelector(`#row-${rowId} td:nth-child(11)`).innerText = formData.get('Core');
                    document.querySelector(`#row-${rowId} td:nth-child(12)`).innerText = formData.get('Observacion');
                    document.getElementById('editarFormContainer').classList.add('hidden');
                }
            };
            xhr.send(formData);
        }

        function eliminarRegistro(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "eliminar.php?id=" + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); // Recargar la página
                    }
                };
                xhr.send();
            }
        }

    </script>
</body>
</html>



<style>
        body {
            background-image: url('../prueba2.jpg');
            background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            background-image: url('../ficha/reporte/cintillo2.png');
            background-size: cover;
            background-position: center;
            height: 200px;
            width: 100%;
            text-align: center;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table-container {
            width: 90%; /* Ajusta el ancho del contenedor */
            max-width: 1200px; /* Ancho máximo del contenedor */
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%; /* Ajusta el ancho de la tabla */
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-button {
            margin: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .hidden { display: none; }
        #editarFormContainer {
            background-color: #f9f9f9; /* Fondo claro */
            border: 1px solid #ccc; /* Borde suave */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            max-width: 600px;
            margin: 20px auto;
        }
        #editarFormContainer h2 {
            color: #333; /* Color de texto oscuro */
        }
        #editarForm label {
            display: block;
            margin-bottom: 5px;
            color: #555; /* Color de texto suave */
        }
        #editarForm input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #editarForm button {
            background-color: #4CAF50; /* Color de botón */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #editarForm button:hover {
            background-color: #45a049; /* Color de botón al pasar el ratón */
        }
    </style>  

