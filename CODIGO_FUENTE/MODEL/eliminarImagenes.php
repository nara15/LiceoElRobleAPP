<?php

    include_once "../CONTROLLER/SQLComandos.php";
    include_once "../CONTROLLER/coneccion.php";



    $str_json = file_get_contents('php://input');
    $JSON_sent = json_decode($str_json, true);
    

    $SqlEliminar = borrarDatos("galeria","idgaleria"/*Restricción*/,$JSON_sent["id"]);
    
    $BaseDeDatos = coneccion();
    
    try
    {
        $ResultadoEjecucion = $BaseDeDatos->query($SqlEliminar);
        unlink($JSON_sent["dir"]);
        echo 'Seccion eliminada con éxito: '.$SqlEliminar;
    }
    catch(Exception $e)
    {
        http_response_code(309);
        echo 'Seccion eliminada con error'.$e->getMessage();
    }
    
    $BaseDeDatos->close();
   

?>