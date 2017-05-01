<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NombreDeLaNoticia = $_GET['nom'];
    $DetalleLink = $_GET['link'];
    $DetalleTexto = $_GET['desc'];
    $DetalleFecha = $_GET['fec'];
    $DetallePath = "";
    mysqli_select_db($BaseDeDatos,"c9");
    //
    $SqlSelectServicios = callProcedures("insertarNoticias", " ' ".$DetalleLink."' , '".$DetalleTexto."','".$DetalleFecha."','No hay','".$NombreDeLaNoticia."'" );
    //
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido";
       
        echo $ConteoFilas.$ResultadoEjecucion;
    } 
    else 
    {
        
        echo ('Agregado Correctamente la noticia '.$NombreDeLaNoticia);
        
        
    }
}
catch(Exception $e)
{
	echo ("Error al insertar 303".$e->getMessage());
}

$BaseDeDatos->close();

?>