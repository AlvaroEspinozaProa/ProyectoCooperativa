<?php
include('../clases/datos.php');

$proeevedor = $_GET['id'];
$fecha = $_GET['f'];
$hora = $_GET['h'];
$direccion = $_GET['s'];
$UNDM = $_GET['undm'];

$datos_sensor_contenedor = new Datos($proeevedor,$fecha,$hora,$direccion,$UNDM);
$datos_sensor_contenedor->ingresodatos();


?>