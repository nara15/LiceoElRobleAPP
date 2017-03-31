<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectMision = consultaUnaColumnaRestriccion("detalle,contenido", "mision","informacion","detalle");
    $SqlSelectVision = consultaUnaColumnaRestriccion("detalle,contenido", "vision","informacion","detalle");
    $ResultaMision = $BaseDeDatos->query($SqlSelectMision);
    $ResultaVision = $BaseDeDatos->query($SqlSelectVision);
    
    $ResultadoRetornar = array();
    
    if ($ResultaMision->num_rows > 0  && $ResultaVision->num_rows >0) 
    {
    
        while($FilasMision = mysqli_fetch_assoc($ResultaMision)) 
        {
            
            $ConteoFilas = utf8_encode($FilasMision["contenido"]);
            $ResultadoRetornar[] = array($FilasMision["detalle"] => $ConteoFilas);

        }
        
        while($FilasVision = mysqli_fetch_assoc($ResultaVision)  ) 
        {
            
            $ConteoFilas = utf8_encode($FilasVision["contenido"]);
            $ResultadoRetornar[] = array($FilasVision["detalle"] => $ConteoFilas);

        }

        $ArregloJSONRetornar = json_encode($ResultadoRetornar);
        echo $ArregloJSONRetornar;
    } 
    else 
    {
        $ResultadoRetornar[] = array("Mision" => "Error");
        $ResultadoRetornar[] = array("Vision"=> "Error");
        $ArregloJSONRetornar = json_encode($ResultadoRetornar);
        echo $ArregloJSONRetornar;
    }

}
catch(Exception $Error)
{
	
    http_response_code(300);
	echo ("Error al insertar 304".$e->getMessage());
}


$BaseDeDatos->close();

?>