<?php
include('../clases/datos.php');

$proeevedor = $_GET['id'];
$Matricula = $_GET['mat'];
$fecha = $_GET['f'];
$hora = $_GET['h'];
$direccion = $_GET['s'];
$producto = $_GET['prod'];
$UNDM = $_GET['undm'];

$datos_sensor_contenedor = new Datos($proeevedor,$Matricula,$fecha,$hora,$direccion,$producto,$UNDM);
$datos_sensor_contenedor->ingresodatos();


?>