<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

$BaseDeDatos = coneccion();

$Seccion = $_GET['sec'];

try
{
    // verificación de entrada, si gusta las noticas asociadas a una sección o todas las noticias (null seccion)
    $SqlSelectServicios = "";
    if($Seccion != null){
        $SqlSelectServicios = callProcedures("seleccinarNoticiasSeccion","'".$Seccion."'");
    }
    if($Seccion == null){
        $SqlSelectServicios = consultaUnaColumna("titulo,link,fecha","noticias");
        
    }
    mysqli_select_db($BaseDeDatos,"c9");
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = ($FilasResultado["titulo"]);
            $Conteolink = ($FilasResultado["link"]);
            $ConteoFech = ($FilasResultado["fecha"]);
            $ResultadoRetornar[] = array("Nom" => $ConteoFilas,"link"=>$Conteolink,"fecha"=>$ConteoFech);
        }
        $JsonRetornar = json_encode($ResultadoRetornar);
        echo $JsonRetornar;
    } 
    else 
    {
        
        $ResuldoRetornar = array();
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