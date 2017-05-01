<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    $NombreDelServicio = $_GET['nom'];
    $ReferenciaImagen = $_GET['imag'];
    $DetalleTexto = $_GET['contenidoTexto'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = callProcedures("crearServicios", " ' ".$NombreDelServicio."' , '".$ReferenciaImagen."','".$DetalleTexto."','No hay más detalles'" );
    
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
        http_response_code(400);
        echo ('Error 402');
    }
}
catch(Exception $e)
{

    http_response_code(300);
	echo ("Error al insertar 303".$e->getMessage());	
}

$BaseDeDatos->close();

?>