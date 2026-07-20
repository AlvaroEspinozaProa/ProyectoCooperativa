<?php
include('../clases/datos.php');

$ID = $_GET['id'];
$IDS = $_GET['ids'];
$fecha = $_GET['f'];
$hora = $_GET['h'];
$datos = $_GET['s'];
$UNDM = $_GET['undm'];

$datos_sensor_contenedor = new Datos($ID,$IDS,$fecha,$hora,$datos,$UNDM);
$datos_sensor_contenedor->ingresodatos();


?>