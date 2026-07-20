<?php
    include('../clases/datos.php');
    $datos = $_GET['n'];

    $borrardatos = new Datos('',$datos,'','','','');
    $borrardatos->BorrarDatos();

?>