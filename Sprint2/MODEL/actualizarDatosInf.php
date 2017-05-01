<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NombreDeLaInfo = $_GET['nom'];
    $Detalle = $_GET['det'];
    mysqli_select_db($BaseDeDatos,"c9");
    $Detalle= utf8_encode($Detalle);
    //
    $SqlSelectServicios = callProcedures($NombreDeLaInfo, " '".$Detalle."'" );
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
        
        echo ('Actualizado correctamente: '.$NombreDeLaInfo);
        
        
    }
}
catch(Exception $e)
{
	echo ("Error al insertar 303".$e->getMessage());
}

$BaseDeDatos->close();

?>