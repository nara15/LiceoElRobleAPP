<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

try
{
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = consultaUnaColumna("nombre","servicios")." order by nombre asc";
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = ($FilasResultado["nombre"]);
            $ResultadoRetornar[] = array("Page" => $ConteoFilas);
        }
        $JsonRetornar = json_encode($ResultadoRetornar);
        echo $JsonRetornar;
    } 
    else 
    {
        
        $ResuldoRetornar = array('Page' => 'Error 302, servicio no econtrado. Probablemente ya no disponible.');
        http_response_code(302);
        echo json_encode($ResuldoRetornar);
    }
}
catch(Exception $e)
{
	
    http_response_code(300);
	echo ("Error al insertar 303".$e->getMessage());
}

$BaseDeDatos->close();

?>