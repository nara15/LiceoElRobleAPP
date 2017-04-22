<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";
include_once "../MODEL/verificarUser.php";


if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	  }

$BaseDeDatos = coneccion();

try
{
    $NombreDeLaInfo = $_GET['nom'];
    $Detalle = $_GET['det'];
    mysqli_select_db($BaseDeDatos,"c9");
    $Detalle= ($Detalle);
    //
    $SqlSelectServicios = callProcedures($NombreDeLaInfo, " '".$Detalle."'" );
    //
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    
    //funcion, tabla, usuario //registro
                
                $Usuario = getUser();
                if($Usuario != "" ){
                    $SqlSelectRegistro = callProcedures("insertarRegistro", " 'editarInformaciónÚnica--"."Detalle: ".$NombreDeLaInfo." DetalleNuevo: ".$Detalle."' , 'Informacion','".$Usuario."'" );
                    $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
                }
    
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido, 306";
       
        echo $ConteoFilas.$ResultadoEjecucion;
    } 
    else 
    {
        
        echo ('Actualizado correctamente: '.$NombreDeLaInfo);
        
        
    }
}
catch(Exception $e)
{
	echo ("Error al insertar 306".$e->getMessage());
}

$BaseDeDatos->close();



function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php";   </script>';
    
}
?>