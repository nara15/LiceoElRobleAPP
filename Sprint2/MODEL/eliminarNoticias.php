<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NombreNoticia = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlEliminarNoticiasSeccion = callProcedures("eliminarNoticasTI","'".$NombreNoticia."'");
    $SqlEliminarNoticias = borrarDatos("noticias","titulo"/*Restricción*/,$NombreNoticia);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEliminarNoticiasSeccion);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEliminarNoticias);
    
   
    
    echo 'Noticia eliminada correctamente '.$NombreNoticia.$SqlEliminarNoticiasSeccion;
}
catch(Exception $e)
{
	die($e->getMessage());
}

$BaseDeDatos->close();

?>