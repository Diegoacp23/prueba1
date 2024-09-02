<?php
require '../ficha/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

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

// Obtener todos los registros
$sql = "SELECT * FROM telecomunicaciones";
$result = $conn->query($sql);

$html = '<center><h1>Reporte de Telecomunicaciones</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="5">';
$html .= '<tr>
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
          </tr>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['Fecha']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['GT']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Uni']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Piso']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Oficina']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['CantEquipos']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['MantHardware']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['MantSoftware']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['DataCenter']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Estatus']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Core']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Observacion']) . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="12">No hay registros</td></tr>';
}
$html .= '</table>';

$conn->close();

// Instanciar y usar la clase Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Opcional) Configurar el tamaño y la orientación del papel
$dompdf->setPaper('A4', 'landscape');

// Renderizar el HTML como PDF
$dompdf->render();

// Salida del PDF generado al navegador
$dompdf->stream("reporte_telecomunicaciones.pdf", array("Attachment" => 0));
?>


