<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";
include_once "../MODEL/verificarUser.php";

if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	     break;
      	  }
      	  
function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}


$BaseDeDatos = coneccion();

try
{
    $NombreServicio = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = borrarDatos("servicios","nombre"/*Restricción*/,$NombreServicio);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $Usuario = getUser();
                if($Usuario != "" ){
                    $SqlSelectRegistro = callProcedures("insertarRegistro", " 'eliminarServicio--"."Detalle: ".$NombreServicio."' , 'Servicios','".$Usuario."'" );
                    $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
                }
   
    
    echo 'Servicio eliminado realizada';
}
catch(Exception $e)
{
    
	http_response_code(308);
	
	echo 'Seccion eliminada con error '.$e->getMessage();
}

$BaseDeDatos->close();

?>