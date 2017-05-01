<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";
include_once "../MODEL/subirImagenes.php";
include_once "../MODEL/verificarUser.php";


 if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlert("Usuario ya no disponible");
      	  }


//Obtener los datos del POST
$NombreDelServicio = $_POST['serviceName']; //serviceNameNuevo
$NombreDelServicioNuevo = $_POST['serviceNameNuevo'];
$DetalleTexto = $_POST['contenidoTexto'];

// Instancia para almacenar la imagen

    if (strlen($NombreDelServicio) >0 and strlen($NombreDelServicio) <90 and strlen($NombreDelServicioNuevo) >0 and strlen($NombreDelServicioNuevo))
    {
    
        if(strlen($DetalleTexto) >0 and strlen($DetalleTexto) <4000)
        {
            $BaseDeDatos = coneccion();
            try
            {
                mysqli_select_db($BaseDeDatos,"c9");
                $SqlSelectServicios = callProcedures("editarServicio", " '".$NombreDelServicio."' , '".$DetalleTexto."','".$NombreDelServicioNuevo."'" );
                $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
                
                //funcion, tabla, usuario //registro
                
                $Usuario = getUser();
                if($Usuario != "" ){
                    $SqlSelectRegistro = callProcedures("insertarRegistro", " 'editarServicio--"."NombreServicio: ".$NombreDelServicio." DetalleNuevo: ".$DetalleTexto."' , 'Servicios','".$Usuario."'" );
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
                    http_response_code(402);
                    phpAlert($ConteoFilas);
                
                } 
                else 
                {
                    
                    phpAlert(' El servicio: fue editado correctamente: '.$NombreDeLaInfo);
                }
            }
            catch(Exception $e)
            {
                http_response_code(300);
                phpAlert ("Error al insertar 303 ".$e->getMessage());	
            }
            
            $BaseDeDatos->close();
        }
        else
        {
            phpAlert("Contenido de la noticia inválido, muy largo o muy corto");
        }
    }
    else
    {
        phpAlert("Nombre del servicio inválido, muy largo o muy corto");
    }



function phpAlert($msg) 
{
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = " https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/servicioEd";   </script>';
    
}

/*
if (strlen($NombreDelServicio) >0 and strlen($NombreDelServicio) <90){
    
    if(strlen($DetalleTexto) >0 and strlen($DetalleTexto) <4000){
    
            
            
            $BaseDeDatos = coneccion();
            
            try
            {
               
                mysqli_select_db($BaseDeDatos,"c9");
                $SqlSelectServicios = callProcedures("crearServicios", " ' ".$NombreDelServicio."' , '".$ReferenciaImagen."','".$DetalleTexto."','No hay más detalles'" );
                $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
                
                $ResultadoRetornar = array();
                
                if ($ResultadoEjecucion->num_rows > 0 ) 
                {
                     $ConteoFilas = "Error Antes de la ejecución no reconocido";
                    while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
                    {
                        $ConteoFilas = utf8_encode($FilasResultado["Mensaje"]);
                        
                    }
                    
                    
                    //sleep(3);
                    //header('Location: https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/servicio');
                    phpAlert($ConteoFilas);
                    //curl_exec($Desvio);
                    
                    
                } 
                else 
                {
                    
                    $ResuldoRetornar = array('Error' => 'Error 402');
                    http_response_code(400);
                    echo ('Error 402');
                }
            }
            catch(Exception $e)
            {
            
                http_response_code(300);
            	echo ("Error al insertar 303".$e->getMessage());	
            }
            
            $BaseDeDatos->close();
            }
            else{
                
                 phpAlert("Contenido de la noticia inválido, muy largo o muy corto");
            }
}
else{
    
    phpAlert("Nombre del servicio inválido, muy largo o muy corto");
}
function phpAlert($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = " https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/servicio";   </script>';
    
}














*/
//echo var_dump($_POST);

/*
$BaseDeDatos = coneccion();

try
{
    $NombreDelServicio = $_POST['nom'];
    $ReferenciaImagen = $_POST['imag'];
    $DetalleTexto = $_POST['contenidoTexto'];
    mysqli_select_db($BaseDeDatos,"c9");
    $SqlSelectServicios = callProcedures("crearServicios", " ' ".$NombreDelServicio."' , '".$ReferenciaImagen."','".$DetalleTexto."','No hay más detalles'" );
    printf($DetalleTexto);
    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
    
    $ResultadoRetornar = array();
    
    if ($ResultadoEjecucion->num_rows > 0 ) 
    {
         $ConteoFilas = "Error Antes de la ejecución no reconocido";
        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
        {
            $ConteoFilas = utf8_encode($FilasResultado["Mensaje"]);
            
        }
        echo $ConteoFilas;
    } 
    else 
    {
        
        $ResuldoRetornar = array('Error' => 'Error 402');
        http_response_code(400);
        echo ('Error 402');
    }
}
catch(Exception $e)
{

    http_response_code(300);
	echo ("Error al insertar 303".$e->getMessage());	
}

$BaseDeDatos->close();
*/
?>