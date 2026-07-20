<?php
    include('../clases/registro.php');
    $usuario = $_GET['n'];
    $correo = $_GET['ce'];
    $contraseña = $_GET['ca'];
    $ccontraseña = $_GET['cc'];

    $Nusuario = new usuario($correo,$contraseña,$usuario,$ccontraseña);
    $Nusuario->NuevoUsuario();
    





?>