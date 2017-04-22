<?php
    include_once "../CONTROLLER/coneccion.php";
    include_once "../CONTROLLER/SQLComandos.php";
    
    $BaseDeDatos = coneccion();
    mysqli_select_db($BaseDeDatos,"c9");
    
    try
    {
        $NoticiaConsultar = $_GET['nombreNoticia'];
        $SqlSelectNoticia = consultaUnaColumnaRestriccion("`descripcion`,`fecha`,`pathImagen`",$NoticiaConsultar/*Restricción*/,"noticias","titulo");
        $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectNoticia);
        
        $ResultadoRetornar = array();
        
        if ($ResultadoEjecucion->num_rows > 0)
        {
            while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
            {
                $ResultadoRetornar[] = array("descripcion" => $FilasResultado["descripcion"]);
                
                $ResultadoRetornar[] = array("fecha" => $FilasResultado["fecha"]);
                
                $ResultadoRetornar[] = array("imagen" => $FilasResultado["pathImagen"]);
            }
            $JsonRetornar = json_encode($ResultadoRetornar);
            echo $JsonRetornar;
        }
    
    }
    catch(Exception $e)
    {
        http_response_code(305);
        echo ("Error al insertar 305".$e->getMessage());
    }
    
    $BaseDeDatos->close();

?>