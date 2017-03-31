<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $SeccionEliminar = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = borrarDatos("seccion","seccion"/*Restricción*/,$SeccionEliminar);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    printf($ResultadoEjecucion);
  
    echo 'Seccion eliminada con éxito';
}
catch(Exception $e)
{
	die($e->getMessage());
	echo 'Seccion eliminada con error'.$e->getMessage();
}

$BaseDeDatos->close();

?>