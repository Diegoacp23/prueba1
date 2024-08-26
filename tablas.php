<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "ficha_tecnica");

// Inicializa $usuarios como un array vacío
$usuarios = array();

// Consulta a la base de datos
$query = "SELECT * FROM ficha";
$result = mysqli_query($conexion, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $usuarios[] = $row;
    }
}

// Verifica si $usuarios no está vacío antes de usar foreach
if (!empty($usuarios)) {
    foreach ($usuarios as $usuario) {
        // Tu código aquí
    }
} else {
    echo "No se encontraron usuarios.";
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Buscar datos en tiempo real con PHP, MySQL y AJAX">
    <meta name="author" content="Marco Robles">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favi.ico"/>
    <link rel="stylesheet" href="reporte/cintillo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <img src= "reporte/cintillo2.png" id="cinti"/>
    <title>Ficha Tecnica</title>
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
th {
      background-color: #f93e3e;
    
}

body{
    background-image: url(final.avif);
}
  </style>
</head> 

<body>

<nav>    
        <ul>               
        <li><a class="active" href="http://localhost/proyecto/dashboard.php"><button>Atras<button\></a></li>     
        </ul>
        </nav>

    <main>




        <div class="container py-4 text-center">
            <h2>Usuarios</h2>

            <div>
              <div class="text-right"> 
              <a href="" class="btn btn-success">Actas de Entregas</a>  

</div>
          <div class="row g-4">

                <div class="col-auto text-start">
                    <label for="num_registros" class="col-form-label"> <b> <p style="color:brown";> Mostrar</p></b> </label>
                </div>

                <div class="col-auto text-start">
                    <select name="num_registros" id="num_registros" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="col-auto text-start">
                    <label for="num_registros" class="col-form-label">registros </label>
                </div>

                <div class="col-md-4 col-xl-5"></div>

                <div class="col-6 col-md-1 text-end">
                    <label for="campo" class="col-form-label">Buscar: </label>
                </div>
                <div class="col-6 col-md-3 text-end">
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>
            <div class="row py-4">
                <div class="col">
      <table id="tabla-usuarios">
  <thead>
    <tr>
      <th>Usuario</th>
      <th>Piso</th>
      <th>Ubi</th>
      <th>@</th>
      <th>Model</th>
      <th>Serial</th>
      <th>Dir Ip</th>
      <th>Dir Mac</th>
      <th>System</th>
      <th>Alm</th>
      <th>Ram</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="content">
    <?php foreach ($usuarios as $usuario) { ?>
    <tr>
      <td><?= $usuario['usuario'] ?></td>
      <td><?= $usuario['piso'] ?></td>
      <td><?= $usuario['ubicacion'] ?></td>
      <td><?= $usuario['marca'] ?></td>
      <td><?= $usuario['modelo'] ?></td>
      <td><?= $usuario['serial'] ?></td>
      <td><?= $usuario['direccion_ip'] ?></td>
      <td><?= $usuario['mac_address'] ?></td>
      <td><?= $usuario['sistema'] ?></td>
      <td><?= $usuario['almacenamiento'] ?></td>
      <td><?= $usuario['memoria'] ?></td>
      <td>
      <!-- Modal -->
<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nuevoValor">Nuevo Valor</label>
                        <input type="text" class="form-control" id="nuevoValor" name="nuevoValor">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitEditForm()">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
</div>
</div>

<div class="row justify-content-between">
    <div class="col-12 col-md-4">
        <label id="lbl-total"></label>
    </div>
    <div class="col-12 col-md-4" id="nav-paginacion"></div>
    <input type="hidden" id="pagina" value="1">
    <input type="hidden" id="orderCol" value="0">
    <input type="hidden" id="orderType" value="asc">
</div>
</div>
</main>

    <script>
function editarUsuario(usuario) {
    // Rellenar el formulario con los datos del usuario
    $('#usuario').val(usuario);
    $('#nuevoValor').val(''); // Puedes rellenar esto con el valor actual si lo tienes

    // Mostrar el modal
    $('#editModal').modal('show');
}

function submitEditForm() {
    var usuario = $('#usuario').val();
    var nuevoValor = $('#nuevoValor').val();

    $.ajax({
        url: 'editar.php',
        type: 'POST',
        data: { usuario: usuario, nuevoValor: nuevoValor },
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                alert('Usuario editado exitosamente');
                location.reload(); // Recarga la página para ver los cambios
            } else {
                alert('Error: ' + result.message);
            }
        }
    });
}




        // Llamando a la función getData() al cargar la página
        document.addEventListener("DOMContentLoaded", getData);

        // Función para obtener datos con AJAX
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value || 1;
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value

            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)

            fetch("load.php", {
                    method: "POST",
                    body: formaData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.data, 'hola')
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = `Mostrando ${data.totalFiltro} de ${data.totalRegistros} registros`;
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion

                    // Si la página actual no tiene resultados, ajustar la paginación para mostrar la primera página
                    if (data.data.includes('Sin resultados') && parseInt(pagina) !== 1) {
                        nextPage(1); // Ir a la primera página
                    }
                })
                .catch(err => console.log(err))
        }

        // Función para cambiar de página
        function nextPage(pagina) {
            document.getElementById('pagina').value = pagina
            getData()
        }

        // Función para ordenar columnas
        function ordenar(e) {
            let elemento = e.target;
            let orderType = elemento.classList.contains("asc") ? "desc" : "asc";

            document.getElementById('orderCol').value = elemento.cellIndex;
            document.getElementById("orderType").value = orderType;
            elemento.classList.toggle("asc");
            elemento.classList.toggle("desc");

            getData()
        }

        // Event listeners para los eventos de cambio en el campo de entrada y el select
        document.getElementById("campo").addEventListener("keyup", getData);
        document.getElementById("num_registros").addEventListener("change", getData);

        // Event listener para ordenar las columnas
        let columns = document.querySelectorAll(".sort");
        columns.forEach(column => {
            column.addEventListener("click", ordenar);
        });
    </script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   


</body>

</html>
