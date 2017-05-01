<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";


if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	  }

$BaseDeDatos = coneccion();

try
{
    $Funcion = $_GET['tip'];
    $Usuario = $_GET['usu'];
    $Pass = $_GET['pass'];
    mysqli_select_db($BaseDeDatos,"c9");
    //$Detalle= utf8_encode($Detalle);
    //
    if($Funcion == "1"){
        
        $SqlActualizar = callProcedures("actualizarContrasenia", " '".$Usuario."','".$Pass."'" );
        //echo $SqlSelectServicios;
    //
        $ResultadoEjecucion = $BaseDeDatos->query($SqlActualizar);
        
        $ResultadoRetornar = array();
        
        if ($ResultadoEjecucion->num_rows > 0 ) 
        {
             $ConteoFilas = "Error Antes de la ejecución no reconocido, 306";
           
            echo $ConteoFilas;
        } 
        else 
        {
            
            echo ('Usuario agregado exitosamente: '.$Usuario);
            
            
        }/**/
        
        
    }
    else{
        $SqlBorrarUsuarios = borrarDatos("usarios", "nombreUsuario",$Usuario);
        //echo $SqlSelectServicios;
    //
        $ResultadoEjecucion = $BaseDeDatos->query($SqlBorrarUsuarios);
        
        $ResultadoRetornar = array();
        
        if ($ResultadoEjecucion->num_rows > 0 ) 
        {
             $ConteoFilas = "Error Antes de la ejecución no reconocido, 306";
           
            echo $ConteoFilas;
        } 
        else 
        {
            
            echo ('Eliminado correctamente: '.$Usuario);
            
            
        }/**/
        
    }
   
}
catch(Exception $e)
{
	echo ("Error al insertar 306".$e->getMessage());
}

$BaseDeDatos->close();


function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}
?>