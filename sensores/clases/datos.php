<?php
    include('../../clase/base.php');

    class Datos {
        private $ID;
        private $IDS;
        private $fecha;
        private $hora;
        private $datos;
        private $UNDM;

        public function __construct($id,$ids,$f,$h,$d,$undm) {
            $this->ID = $id;
            $this->IDS = $ids;
            $this->fecha = $f;
            $this->hora = $h;
            $this->datos = $d;
            $this->UNDM = $undm;
        }
        // ... Aquí irían tus propiedades y constructor
        public function ingresodatos() {
            $sql = "INSERT INTO datos_sensores (ID, IDS, fecha, hora, datos, UNDM)
                    VALUES ('$this->ID', '$this->IDS', '$this->fecha', '$this->hora', '$this->datos', '$this->UNDM');";

            $bd = new BaseDeDatos('localhost','3307','','root','','test');
            if ($bd->connect()) {
                $bd->executeQuery($sql);
                $bd->close();

                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registro Insertado</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
                    <style>
                        body {
                            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
                            font-family: "Segoe UI", sans-serif;
                            min-height: 100vh;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                        .card {
                            border: none;
                            border-radius: 20px;
                            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                        }
                        .btn-custom {
                            background-color: #1976d2;
                            border: none;
                            transition: 0.3s;
                        }
                        .btn-custom:hover {
                            background-color: #0d47a1;
                            transform: scale(1.05);
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="card text-center p-5">
                            <div class="card-body">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                                <h3 class="mt-3 text-success">¡Registro Insertado Correctamente!</h3>
                                <p class="text-muted">Los datos del sensor fueron almacenados exitosamente en la base de datos.</p>
                                <a href="../front/ingresodatos.html" class="btn btn-custom text-white mt-3"><i class="bi bi-arrow-left-circle"></i> Volver</a>
                                <a href="../sistema.html" class="btn btn-outline-secondary mt-3"><i class="bi bi-house"></i> Inicio</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>';
            }
        }

        public function ActualizarDatos($nuevodato) {
            $bd = new BaseDeDatos('localhost','3307','','root','','test');
            if ($bd->connect()) {
                $sql = "UPDATE datos_sensores SET datos = '$nuevodato' WHERE IDS = '$this->IDS'";
                $bd->executeQuery($sql);
                $bd->close();

                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registro Actualizado</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
                    <style>
                        body {
                            background: linear-gradient(135deg, #c8e6c9, #a5d6a7);
                            font-family: "Segoe UI", sans-serif;
                            min-height: 100vh;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                        .card {
                            border: none;
                            border-radius: 20px;
                            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                        }
                        .btn-custom {
                            background-color: #2e7d32;
                            border: none;
                            transition: 0.3s;
                        }
                        .btn-custom:hover {
                            background-color: #1b5e20;
                            transform: scale(1.05);
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="card text-center p-5">
                            <div class="card-body">
                                <i class="bi bi-arrow-repeat text-success" style="font-size: 4rem;"></i>
                                <h3 class="mt-3 text-success">¡Registro Actualizado!</h3>
                                <p class="text-muted">El dato del sensor se modificó correctamente en la base de datos.</p>
                                <a href="../front/actualizardatos.html" class="btn btn-custom text-white mt-3"><i class="bi bi-arrow-left-circle"></i> Volver</a>
                                <a href="../sistema.html" class="btn btn-outline-secondary mt-3"><i class="bi bi-house"></i> Inicio</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>';
            }
        }

        public function BorrarDatos() {
            $bd = new BaseDeDatos('localhost','3307','','root','','test');
            if ($bd->connect()) {
                $sql = "DELETE FROM datos_sensores WHERE IDS = '$this->IDS'";
                $bd->executeQuery($sql);
                $bd->close();

                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registro Borrado</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
                    <style>
                        body {
                            background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
                            font-family: "Segoe UI", sans-serif;
                            min-height: 100vh;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                        .card {
                            border: none;
                            border-radius: 20px;
                            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                        }
                        .btn-custom {
                            background-color: #d32f2f;
                            border: none;
                            transition: 0.3s;
                        }
                        .btn-custom:hover {
                            background-color: #b71c1c;
                            transform: scale(1.05);
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="card text-center p-5">
                            <div class="card-body">
                                <i class="bi bi-trash3-fill text-danger" style="font-size: 4rem;"></i>
                                <h3 class="mt-3 text-danger">¡Registro Eliminado!</h3>
                                <p class="text-muted">El registro del sensor fue eliminado correctamente de la base de datos.</p>
                                <a href="../front/borrardatos.html" class="btn btn-custom text-white mt-3"><i class="bi bi-arrow-left-circle"></i> Volver</a>
                                <a href="../sistema.html" class="btn btn-outline-secondary mt-3"><i class="bi bi-house"></i> Inicio</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>';
            }
        }

        public function reporte() {

            $bd = new BaseDeDatos('localhost','3307','','root','','test');

            if ($bd->connect()) {

                // Obtener sensores para el SELECT
                $sql_sensores = "SELECT DISTINCT IDS FROM datos_sensores ORDER BY IDS ASC;";
                $sensores = $bd->executeQuery($sql_sensores);

                // Obtener parámetros GET
                $inputID = isset($_GET['buscar_id']) ? trim($_GET['buscar_id']) : "";
                $selectID = isset($_GET['sensor']) ? $_GET['sensor'] : "todos";

                // Lógica del filtro
                if ($inputID !== "") {
                    $sql = "SELECT * FROM datos_sensores WHERE IDS = '$inputID';";
                    $filtroActivo = $inputID;
                } elseif ($selectID !== "todos") {
                    $sql = "SELECT * FROM datos_sensores WHERE IDS = '$selectID';";
                    $filtroActivo = $selectID;
                } else {
                    $sql = "SELECT * FROM datos_sensores;";
                    $filtroActivo = "todos";
                }

                $resultado = $bd->executeQuery($sql);

                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Reporte de Sensores</title>

                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

                    <style>
                        body {
                            background: linear-gradient(135deg, #bbdefb, #e3f2fd);
                            min-height: 100vh;
                            font-family: "Segoe UI", sans-serif;
                        }
                        .navbar {
                            background-color: #0d47a1 !important;
                        }
                        .navbar-brand, .nav-link {
                            color: white !important;
                        }
                        .navbar-brand:hover, .nav-link:hover {
                            color: #bbdefb !important;
                        }
                    </style>
                </head>

                <body>

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container">
                        <a class="navbar-brand fw-bold" href="../sistema.html"><i class="bi bi-cpu"></i> EcoTidy</a>
                    </div>
                </nav>

                <div class="container mt-5">

                    <!-- Tarjeta filtro -->
                    <div class="card shadow-lg mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="bi bi-search"></i> Buscar datos de sensores</h4>
                        </div>

                        <div class="card-body">

                            <form method="GET" class="row g-3">

                                <!-- Input manual -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Ingresar ID del sensor</label>
                                    <input 
                                        type="number" 
                                        name="buscar_id" 
                                        class="form-control" 
                                        placeholder="Ej: 101" 
                                        value="'.($inputID !== "" ? $inputID : "").'"
                                    >
                                </div>

                                <!-- Select de sensores -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Seleccionar sensor</label>
                                    <select name="sensor" class="form-select">
                                        <option value="todos">Todos</option>';

                                        while ($s = $sensores->fetch_assoc()) {
                                            $id = $s["IDS"];
                                            $selected = ($selectID == $id) ? "selected" : "";
                                            echo "<option value=\"$id\" $selected>Sensor $id</option>";
                                        }

                                echo '
                                    </select>
                                </div>

                                <!-- Botón buscar -->
                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>

                                <!-- Botón ver todos -->
                                <div class="col-md-2 d-flex align-items-end">
                                    <a href="?sensor=todos&buscar_id=" class="btn btn-secondary w-100">
                                        <i class="bi bi-list"></i> Ver todos
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                ';

                // Mostrar tabla
                if ($resultado && $resultado->num_rows > 0) {

                    echo '
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="bi bi-file-earmark-bar-graph"></i> Datos Registrados</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Contenedor</th>
                                            <th>Sensor</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Datos</th>
                                            <th>Unidad de Medida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    ';

                    while ($fila = $resultado->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$fila['ID']}</td>
                                <td>{$fila['IDS']}</td>
                                <td>{$fila['fecha']}</td>
                                <td>{$fila['hora']}</td>
                                <td>{$fila['datos']}</td>
                                <td>{$fila['UNDM']}</td>
                            </tr>
                        ";
                    }

                    echo '
                                    </tbody>
                                </table>
                            </div>

                            <a href="../front/reporte.html" class="btn btn-secondary mt-3">
                                <i class="bi bi-house"></i> Volver
                            </a>
                        </div>
                    </div>
                    ';

                } else {
                    echo "
                        <div class='alert alert-warning text-center shadow-sm'>
                            <i class='bi bi-exclamation-triangle'></i> 
                            No hay datos para el filtro seleccionado.
                        </div>
                    ";
                }

                echo "</div></body></html>";

                $bd->close();

            } else {
                echo "<div class='alert alert-danger mt-5 text-center'>
                        Error al conectar con la base de datos.
                    </div>";
            }
        }

    }




?>