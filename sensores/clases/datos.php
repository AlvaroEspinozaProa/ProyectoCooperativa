<?php
    include('../../clase/base.php');

    class Datos {
        private $proveedor;
        private $fecha;
        private $hora;
        private $direccion;
        private $UNDM;

        public function __construct($pro,$f,$h,$d,$undm) {
            $this->proveedor = $pro;
            $this->fecha = $f;
            $this->hora = $h;
            $this->direccion = $d;
            $this->UNDM = $undm;
        }
        // ... Aquí irían tus propiedades y constructor
        public function ingresodatos() {
            $sql = "INSERT INTO datos_sensores (proveedor, fecha, hora, direccion, UNDM)
                    VALUES ('$this->proveedor', '$this->fecha', '$this->hora', '$this->direccion', '$this->UNDM');";

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

                // Obtener proveedores para el SELECT
                $sql_sensores = "SELECT DISTINCT proveedor FROM datos_sensores ORDER BY proveedor ASC;";
                $sensores = $bd->executeQuery($sql_sensores);

                // Obtener parámetros GET
                $inputProveedor = isset($_GET['buscar_proveedor']) ? trim($_GET['buscar_proveedor']) : "";
                $selectProveedor = isset($_GET['proveedor']) ? $_GET['proveedor'] : "todos";

                // Lógica del filtro
                if ($inputProveedor != "") {
                    $sql = "SELECT * FROM datos_sensores WHERE proveedor = '$inputProveedor';";
                } elseif ($selectProveedor != "todos") {
                    $sql = "SELECT * FROM datos_sensores WHERE proveedor = '$selectProveedor';";
                } else {
                    $sql = "SELECT * FROM datos_sensores;";
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

                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container">
                        <a class="navbar-brand fw-bold" href="../sistema.html">
                            <i class="bi bi-cpu"></i> EcoTidy
                        </a>
                    </div>
                </nav>

                <div class="container mt-5">

                    <div class="card shadow-lg mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-search"></i> Buscar datos de sensores
                            </h4>
                        </div>

                        <div class="card-body">

                            <form method="GET" class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Ingresar proveedor</label>
                                    <input
                                        type="text"
                                        name="buscar_proveedor"
                                        class="form-control"
                                        placeholder="Ej: EcoTidy"
                                        value="'.($inputProveedor != "" ? $inputProveedor : "").'"
                                    >
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Seleccionar proveedor</label>
                                    <select name="proveedor" class="form-select">
                                        <option value="todos">Todos</option>';

                                        while ($s = $sensores->fetch_assoc()) {
                                            $proveedor = $s["proveedor"];
                                            $selected = ($selectProveedor == $proveedor) ? "selected" : "";
                                            echo "<option value=\"$proveedor\" $selected>$proveedor</option>";
                                        }

                echo '
                                    </select>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <a href="?proveedor=todos&buscar_proveedor=" class="btn btn-secondary w-100">
                                        <i class="bi bi-list"></i> Ver todos
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                ';

                if ($resultado && $resultado->num_rows > 0) {

                    echo '
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-file-earmark-bar-graph"></i> Datos Registrados
                            </h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Proveedor</th>
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
                                <td>{$fila['proveedor']}</td>
                                <td>{$fila['fecha']}</td>
                                <td>{$fila['hora']}</td>
                                <td>{$fila['direccion']}</td>
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

                echo "
                <div class='alert alert-danger mt-5 text-center'>
                    Error al conectar con la base de datos.
                </div>
                ";

            }
        }
    }
?>