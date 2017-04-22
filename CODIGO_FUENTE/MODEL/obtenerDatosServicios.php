<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";



 

$BaseDeDatos = coneccion();

try
{
    $ServicioConsultar = $_GET['serv'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = consultaUnaColumnaRestriccion("`imagen`,`detalle`,`detalle_imagen`",$ServicioConsultar/*Restricción*/,"servicios","nombre");
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = ($FilasResultado["imagen"]);
            $ResultadoRetornar[] = array("imagen" => $ConteoFilas);
            $ConteoFilas = ($FilasResultado["detalle"]);
            $ResultadoRetornar[] = array("detalle" => $ConteoFilas);
            $ConteoFilas = ($FilasResultado["detalle_imagen"]);
            $ResultadoRetornar[] = array("detalle_imagen" => $ConteoFilas);
            
            
        }
        $JsonRetornar = json_encode($ResultadoRetornar);
        echo $JsonRetornar;
    } 
    else 
    {
        
        $ResuldoRetornar = array('Page' => 'Error 300');
        http_response_code(304);
        echo json_encode($ResuldoRetornar);
    }
}
catch(Exception $e)
{
	
    http_response_code(305);
	echo ("Error al insertar 305".$e->getMessage());
}

$BaseDeDatos->close();

?>