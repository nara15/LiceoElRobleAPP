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
    $SeccionEliminar = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = borrarDatos("seccion","seccion"/*Restricción*/,$SeccionEliminar);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
     $Usuario = getUser();
            if($Usuario != "" ){
                $SqlSelectRegistro = callProcedures("insertarRegistro", " 'eliminarSecciones--"."Detalle: ".$SeccionEliminar."' , 'Secciones','".$Usuario."'" );
                $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
            }
    
    
    
  
    echo 'Seccion eliminada con éxito: '.$SeccionEliminar;
}
catch(Exception $e)
{
    
	http_response_code(309);
	echo 'Seccion eliminada con error'.$e->getMessage();
}

$BaseDeDatos->close();

?>