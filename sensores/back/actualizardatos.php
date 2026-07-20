<?php
include('../clases/datos.php');
$sensor = $_GET['s'];
$datos = $_GET['d'];
$undm = $_GET['undm'];

$Actdatos = new Datos('',$sensor, '','',$datos,$undm);
$Actdatos->ActualizarDatos($datos);


?>