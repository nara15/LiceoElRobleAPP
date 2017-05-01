<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NuevaSeccion = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = callProcedures("insertarSeccion", " ' ".$NuevaSeccion."' " );
    
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido";
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = utf8_encode($FilasResultado["Mensaje"]);
            
            
        }
        echo $ConteoFilas;
    } 
    else 
    {
        
        $ResuldoRetornar = array('Error' => 'Error 402');
        
        echo "Agregado con éxito";
    }
}
catch(Exception $e)
{
     echo "Agregado sin éxito ".$e->getMessage();
}

$BaseDeDatos->close();

?>