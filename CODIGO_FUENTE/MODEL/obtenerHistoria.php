<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos =coneccion();
$ResultadoRetornar = array();
try
{
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlEjecucuionHistoria = consultaUnaColumnaRestriccion("detalle,contenido", "historia","informacion","detalle");
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEjecucuionHistoria);
    
  
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
    
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            
            $ConteoFilas = ($FilasResultado["contenido"]);
            $ResultadoRetornar[] = array($FilasResultado["detalle"] => $ConteoFilas);

        }
        
        
        
        $JsonRetornar = json_encode($ResultadoRetornar);
        echo $JsonRetornar;
    } 
    else 
    {
        $ResultadoRetornar[] = array("Historia" => "Error 401");
        http_response_code(401);
        $JsonRetornar = json_encode($ResultadoRetornar);
        echo $JsonRetornar;
    }

}
catch(Exception $e)
{
    
    $ResultadoRetornar[] = array("Historia" => ("Error 301"+$e->getMessage()));
    http_response_code(301);
    $JsonRetornar = json_encode($ResultadoRetornar);
    echo $JsonRetornar;
	
}


$BaseDeDatos->close();

?>