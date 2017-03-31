<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NombreServicio = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = borrarDatos("servicios","nombre"/*Restricción*/,$NombreServicio);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
   
    
    echo 'Servicio eliminado realizada';
}
catch(Exception $e)
{
	die($e->getMessage());
}

$BaseDeDatos->close();

?>