<?php
include('../../clase/base.php');

class usuario {
    private $correo;
    private $usuario;
    private $contraseña;
    private $confirmar_contraseña;

    public function __construct($co,$c,$u,$cc) {
        $this->correo = $co;
        $this->usuario = $u;
        $this->contraseña = $c;
        $this->confirmar_contraseña = $cc;
    }

    /* ╔═══════════════════════════════════════════╗
       ║        INSERTAR NUEVO USUARIO            ║
       ╚═══════════════════════════════════════════╝ */
    public function NuevoUsuario(){

        $sql = "INSERT INTO usuarios (correo, nombre_usuario, contraseña, confirmar_contraseña)
                VALUES ('$this->correo', '$this->usuario', '$this->contraseña', '$this->confirmar_contraseña');";

        $bd = new BaseDeDatos('localhost','3307','','root','','test');

        if ($bd->connect()){
            $bd->executeQuery($sql);
            $bd->close();

            echo '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Usuario Registrado</title>
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
                            <i class="bi bi-person-check-fill text-success" style="font-size: 4rem;"></i>
                            <h3 class="mt-3 text-success">¡Usuario Registrado!</h3>
                            <p class="text-muted">El usuario fue agregado correctamente a la base de datos.</p>
                            <a href="../front/formulario_registro.html" class="btn btn-custom text-white mt-3">
                                <i class="bi bi-arrow-left-circle"></i> Volver
                            </a>
                            <a href="../../home_page.html" class="btn btn-outline-secondary mt-3">
                                <i class="bi bi-house"></i> Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
        }
    }

    /* ╔═══════════════════════════════════════════╗
       ║              CAMBIAR CONTRASEÑA          ║
       ╚═══════════════════════════════════════════╝ */
    public function cambiarcontraseña($cs){

        $bd = new BaseDeDatos('localhost','3307','','root','','test');
        
        if ($bd->connect()){
            $sql = "UPDATE usuarios SET contraseña = '$cs' WHERE nombre_usuario = '$this->usuario'";
            $bd->executeQuery($sql);
            $bd->close();

            echo '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Contraseña Actualizada</title>
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
                            <i class="bi bi-shield-lock-fill text-success" style="font-size: 4rem;"></i>
                            <h3 class="mt-3 text-success">¡Contraseña Actualizada!</h3>
                            <p class="text-muted">La contraseña se ha modificado correctamente.</p>

                            <a href="../front/cambio_contraseña.html" class="btn btn-custom text-white mt-3">
                                <i class="bi bi-arrow-left-circle"></i> Volver
                            </a>
                            <a href="../../home_page.html" class="btn btn-outline-secondary mt-3">
                                <i class="bi bi-house"></i> Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
        }
    }

    /* ╔═══════════════════════════════════════════╗
       ║              INGRESAR USUARIO            ║
       ╚═══════════════════════════════════════════╝ */
    public function ingresarUsuario($usua){

        $sql = "SELECT COUNT(*) valor from usuarios 
                where nombre_usuario = '$usua' AND contraseña = '$this->contraseña';"; 

        $bd = new BaseDeDatos('localhost','3307','','root','','test');

        if ($bd->connect()){
            $resultado = $bd->executeQuery($sql);
            $fila = $resultado->fetch_assoc();

            if($fila['valor']== 1){
                return 1;
            } else {

                echo '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Error de Inicio de Sesión</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
                </head>
                <body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
                    <div class="card shadow-lg p-4 text-center">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size:4rem;"></i>
                        <h3 class="mt-3 text-danger">Datos Incorrectos</h3>
                        <p class="text-muted">El usuario o la contraseña no coinciden.</p>
                        <a href="home_page.html" class="btn btn-danger mt-3">
                           <i class="bi bi-arrow-left-circle"></i> Reintentar
                        </a>
                    </div>
                </body>
                </html>';
                return 0;
            }

            $bd->close();
        }
    }
}

?>
