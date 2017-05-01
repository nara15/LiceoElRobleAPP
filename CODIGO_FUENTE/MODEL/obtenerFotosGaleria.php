<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";


$BaseDeDatos =coneccion();
$ResultadoRetornar = [];

try
{
    
    $BaseDeDatos->query('SET NAMES utf8');
    mysqli_select_db($BaseDeDatos,"c9");
    
    
    $SqlEjecucuionGaleria = consultaUnaColumna("idgaleria,direccion,detalle", "galeria");
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEjecucuionGaleria);
   
    
    if ($ResultadoEjecucion->num_rows > 0)
    {
        while($FilaResultado = mysqli_fetch_assoc($ResultadoEjecucion))
        {
            $ResuldoRetornar[] =  array("id" => $FilaResultado["idgaleria"],
            "direccion" => $FilaResultado["direccion"],
            "detalle" => $FilaResultado["detalle"]);
            
        }
        
         header('Content-Type: application/json; Charset=UTF-8');
        echo json_encode($ResuldoRetornar, JSON_UNESCAPED_UNICODE);
        
        /*
        $arr1=array('result1'=>'abcd','result2'=>'Avión'); 
        $arr2=array('result1'=>'hijk','result2'=>'lmn'); 
        $arr3=array($arr1,$arr2); 
        print (json_encode($arr3, JSON_UNESCAPED_UNICODE));*/
        

    }
}
catch(Exception $e)
{
 
    http_response_code(300);
	echo ("Error al insertar 305".$e->getMessage());   
}


$BaseDeDatos->close();

?>