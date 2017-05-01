<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";
include_once "../MODEL/verificarUser.php";


if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	  }
      	  
function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}


$BaseDeDatos = coneccion();

try
{
    $NuevaSeccion = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
   // $NuevaSeccion = utf8_encode($NuevaSeccion);
    $SqlSelectServicios = callProcedures("insertarSeccion", " ' ".$NuevaSeccion."' " );
    
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    
     $Usuario = getUser();
                if($Usuario != "" ){
                    $SqlSelectRegistro = callProcedures("insertarRegistro", " 'agregarSección--"."Detalle: ".$NuevaSeccion."' , 'Secciones','".$Usuario."'" );
                    $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
                }
    
    
    
    $ResultadoRetornar = array();
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido";
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = utf8_encode($FilasResultado["Mensaje"]);
            
            
        }
        http_response_code(307);
        echo $ConteoFilas;
    } 
    else 
    {
        
        echo "Agregado con éxito la sección: ".$NuevaSeccion;
    }
}
catch(Exception $e)
{
     echo "Agregado sin éxito ".$e->getMessage();
}

$BaseDeDatos->close();

?>