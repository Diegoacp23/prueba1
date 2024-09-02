<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Pisos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header></header>
    <a href="javascript:history.back()" class="back-button">Volver</a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h1 class="form-title">Formulario</h1>
                    <form action="procesar.php" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label for="Fecha" class="col-sm-2 col-form-label">Fecha:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Fecha" id="Fecha" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="GT" class="col-sm-2 col-form-label">Grupo de Trabajo:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="GT" id="GT" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Uni" class="col-sm-2 col-form-label">Unidad:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="Uni" id="Uni" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Piso" class="col-sm-2 col-form-label">Piso:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="Piso" id="Piso" required>
                                    <option value="PB">PB</option>
                                    <option value="MZz">MZz</option>
                                    <?php
                                    for ($i = 1; $i <= 11; $i++) {
                                        echo "<option value='Piso $i'>Piso $i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Oficina" class="col-sm-2 col-form-label">Ente u Oficina:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="Oficina" id="Oficina" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="CantEquipos" class="col-sm-2 col-form-label">Cant. de Equipos:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="CantEquipos" id="CantEquipos" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="MantHardware" class="col-sm-2 col-form-label">Mant. Hardware:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="MantHardware" id="MantHardware" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="MantSoftware" class="col-sm-2 col-form-label">Mant. Software:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="MantSoftware" id="MantSoftware" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DataCenter" class="col-sm-2 col-form-label">Data Center:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="DataCenter" id="DataCenter" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Estatus" class="col-sm-2 col-form-label">Estatus:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="Estatus" id="Estatus" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Core" class="col-sm-2 col-form-label">Core:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="Core" id="Core" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Observacion" class="col-sm-2 col-form-label">Observación:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="Observacion" id="Observacion" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<style>
        body {
            background-image: url('../prueba2.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        .form-container {
            margin-top: 50px;
            background-color: rgba(248, 249, 250, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        header {
            background-image: url('../ficha/reporte/cintillo2.png');
            background-size: cover;
            height: 190px;
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
    </style>
