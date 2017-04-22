<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";

function getUser(){
     if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	      echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../index.html'> " ;
      	  }
      	  else{
    
    
                $BaseDeDatos = coneccion();
                try
                    {
                        mysqli_select_db($BaseDeDatos,"c9");
                                        //
                        $SqlSelectUsers = consultaUnaColumna("nombreUsuario","usarios" );
                        //
                        $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectUsers);
                        
                        if ($ResultadoEjecucion->num_rows > 0 ) 
                        {
                           while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
                                {
                                    $ConteoFilas = ($FilasResultado["nombreUsuario"]);
                                    if(!strcmp($_COOKIE["nombre"],crypt($ConteoFilas,"Usuario"))){
                                        return $ConteoFilas;
                                        break;
                                        
                                    }
                                }
                        } 
                        else 
                        {
                            $ConteoFilas = "Error, contraseña o usuario no válido.";
                        
                            phpAlertDeclinadoUs( $ConteoFilas);
                            
                        }
                        
                        
                        
                        // phpAlert($SqlSelectServicios);
                            
                      
                }
                catch(Exception $e)
                    {
                    	phpAlertDeclinadoUs ("Error al igresar 310".$e->getMessage());
                    }
        
      	  }
    $BaseDeDatos->close();
    
   
}
 function phpAlertDeclinadoUs($msg) {
        echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
        
    }
    function phpAlertConfirmadoUs($msg) {
        echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/";   </script>';
        
    }
?>