<?php
    include('../clases/registro.php');
    $usua = $_GET['usuario'];
    $con = $_GET['contraseña'];
    $corr = $_GET['email'];

    $ingresar = new usuario($corr,$con,$usua,'');
    $r = $ingresar->ingresarUsuario($usua);
    if($r == 1){
        header("Location: http://localhost/TMartinez/TP_trabajo_integrador/sensores/sistema.html");
        exit();
    } else {
        echo "";
    }
?>