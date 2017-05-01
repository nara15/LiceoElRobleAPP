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
    $NombreNoticia = $_GET['nom'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlEliminarNoticiasSeccion = callProcedures("eliminarNoticasTI","'".$NombreNoticia."'");
    $SqlEliminarNoticias = borrarDatos("noticias","titulo"/*Restricción*/,$NombreNoticia);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEliminarNoticiasSeccion);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlEliminarNoticias);
    
   $Usuario = getUser();
                if($Usuario != "" ){
                    $SqlSelectRegistro = callProcedures("insertarRegistro", " 'eliminarNoticias--"."Detalle: ".$NombreNoticia."' , 'Noticias','".$Usuario."'" );
                    $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
                }
    
    echo 'Noticia eliminada correctamente '.$NombreNoticia;
}
catch(Exception $e)
{
	die($e->getMessage());
}

$BaseDeDatos->close();

?>