<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";


if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	  }
      	  
function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}


$BaseDeDatos = coneccion();

try
{
    $NombreDeLaNoticia = $_GET['nom'];
    $DetalleSeccion = $_GET['sec'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = callProcedures("insertarNoticiasXSeccion", " '".$NombreDeLaNoticia."' , '".$DetalleSeccion."'" );
    
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido";
       
        echo $ConteoFilas;
    } 
    else 
    {
        
        echo "Agregado Correctamente la sección: ".$DetalleSeccion." con la sección: ".$NombreDeLaNoticia;
        
    }
}
catch(Exception $e)
{
    http_response_code(300);
	echo ("Error al insertar 303".$e->getMessage());
}

$BaseDeDatos->close();

?>