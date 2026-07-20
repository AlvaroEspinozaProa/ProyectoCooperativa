<?php
    include('../clases/registro.php');
    $user = $_GET['u'];
    $cambiarcontraeñaa = $_GET['ca'];
    $nuevacontraseña = $_GET['nc'];
    $confirmarcontraseñanueva = $_GET['cc'];

    $contraseñanueva = new usuario($user,$cambiarcontraeñaa,$user,$confirmarcontraseñanueva);
    $contraseñanueva->cambiarcontraseña($nuevacontraseña);



?>