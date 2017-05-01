<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";


$BaseDeDatos =coneccion();
$ResultadoRetornar = [];

try
{
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlEjecucuionGaleria = consultaUnaColumna("idgaleria,direccion,detalle", "galeria");
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEjecucuionGaleria);
    
    if ($ResultadoEjecucion->num_rows > 0)
    {
        while($FilaResultado = mysqli_fetch_assoc($ResultadoEjecucion))
        {
            $ResuldoRetornar[] =  
                array(  "id"=>utf8_encode($FilaResultado["idgaleria"]),
                        "direccion"=>utf8_encode($FilaResultado["direccion"]),
                        "detalle"=>utf8_encode($FilaResultado["detalle"]));
        }
        
        echo json_encode($ResuldoRetornar);
        
    }
}
catch(Exception $e)
{
 
    http_response_code(300);
	echo ("Error al insertar 305".$e->getMessage());   
}


$BaseDeDatos->close();

?>