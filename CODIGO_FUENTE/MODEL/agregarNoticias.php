<?php

include_once "../CONTROLLER/coneccion.php";
include_once "../CONTROLLER/SQLComandos.php";
include_once "../MODEL/verificarUser.php";
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/Facebook/');
require_once(__DIR__.'/Facebook/autoload.php');

if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	     phpAlertDeclinado("Usuario ya no disponible");
      	  }
      	  



$BaseDeDatos = coneccion();

  $NombreDeLaNoticia = $_POST['nombreNoticia'];
    $DetalleLink = $_POST['link'];
    $DetalleTexto = $_POST['detalleTexto'];
    $DetalleFecha = $_POST['fechaNoticia'];
    $DetallePath = "No hay" ;
    $Prioritaria = 0;
    $PublicarFacebook = 0;
    
        
    if(0 <strlen( $NombreDeLaNoticia) and  strlen($NombreDeLaNoticia) < 90 ){
        if(0 < strlen($DetalleTexto) and  strlen($DetalleTexto)<4000){
            if(0 < strlen($DetalleFecha) ){
                
                try
                {
                  
                    mysqli_select_db($BaseDeDatos,"c9");
                    //
                    $SqlSelectServicios = callProcedures("insertarNoticias", "'".$DetalleLink."' , '".$DetalleTexto."','".$DetalleFecha."','".$DetallePath."','".$NombreDeLaNoticia."',".$Prioritaria );
                    //
                    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
                    
                    //funcion, tabla, usuario //registro
                
                //-------- Facbook
                    if(isset($_POST['Prioritario']))
                        {
                        $Prioritaria =  ((int) $_POST['Prioritario']);  //  Cual es el valor selecionado
                        }
                            
                    if(isset($_POST['Publicar']))
                    {
                        $PublicarFacebook =  ((int) $_POST['Publicar']);  //  Cual es el valor selecionado
                    }
                    
                    if($PublicarFacebook ==1){
                        
                        $fb = new Facebook\Facebook([
                             'app_id' => '188478668335911',
                             'app_secret' => '31fb09f3d31e6f41a4c15901120ed176',
                             'default_graph_version' => 'v2.8',
                            ]);
                        $linkData = [
                                 'link' => 'centroeducativoelroble-josegarita.c9users.io/index.html',
                                 'message' => $NombreDeLaNoticia."\n\n\n"."Para poder ver en detalles visite el link"
                                 // falta subir imagen
                                 //eje https://centroeducativoelroble-josegarita.c9users.io/Images/services/bosque.jpg
                                 
                                ];
                        $pageAccessToken ='EAACra5wS6ycBAFzCehfH1Ewl3s1LVkh9ONnoCFxInsaZAEZCXKZCD8GEQqx5egIYAaq5CqyXlgzAGq7E6SG1CY4Q2ZBgUEBotmwMWblojH1KlZAk3wHXAbB5YLTc1tIZAZB6EydrrXEoXNjRYLuQBmjZBpacYfHD8NR1migH2u9IweLZAnxqw4RAJoBvu9yHpyRIZD';
                        
                        
                        
                        try {
                             $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
                            } 
                            catch(Facebook\Exceptions\FacebookResponseException $e) {
                                phpAlertDeclinado('Ha ocurrido un error al publicar en Facbook - Graph: '.$e->getMessage()) ;
                                exit;
                            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                                phpAlertDeclinado('Ha ocurrido un error al publicar en Facbook - SDK: '.$e->getMessage()) ;
                                
                            }
                            $graphNode = $response->getGraphNode();
                
                
                
                    }
                
                    //https://developers.facebook.com/tools/explorer/188478668335911?method=GET&path=1381451261893722&version=v2.8

                
                //---- termina facebook
                
                
                
                
                    $Usuario = getUser();
                    if($Usuario != "" ){
                        $SqlSelectRegistro = callProcedures("insertarRegistro", " 'agregarNuevaNoticia--"."Detalle: ".$NombreDeLaNoticia." Fecha: ".$DetalleFecha."' , 'Noticias','".$Usuario."'" );
                        $ResultadoEjecucionTem = $BaseDeDatos->query($SqlSelectRegistro);
                    }
                    
                    
                    
                    $ResultadoRetornar = array();
                    // phpAlert($SqlSelectServicios);
                    if ($ResultadoEjecucion->num_rows > 0 ) 
                    {
                         $ConteoFilas = "Error Antes de la ejecución no reconocido";
                        while($FilasResultado = mysqli_fetch_assoc($ResultadoEjecucion)  ) 
                            {
                                $ConteoFilas = utf8_encode($FilasResultado["Mensaje"]);
                                
                            }
                        phpAlertDeclinado( $ConteoFilas);
                    } 
                    else 
                    {
                        
                        
                        if(!empty($_POST['SeccionesAgregaNot'])) {
                            foreach($_POST['SeccionesAgregaNot'] as $check) {
                                    $SqlSelectServicios = callProcedures("insertarNoticiasXSeccion", " '".$NombreDeLaNoticia."' , '".$check."'" );
                                    
                                    $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
                                    
                                    $ResultadoRetornar = array();
                                    
                                    if ($ResultadoEjecucion->num_rows > 0 ) 
                                    {
                                         $ConteoFilas = "Error Antes de la ejecución no reconocido, no se ha asignado la noticia a ninguna sección";
                                       
                                        phpAlertDeclinado ( $ConteoFilas);
                                    } 
                                   
                            }
                             phpAlertDeclinado ('Agregado Correctamente la noticia y asociada a sus secciones '.$NombreDeLaNoticia);
                            
                        }
                        else{
                            phpAlertDeclinado ('Agregado Correctamente la noticia '.$NombreDeLaNoticia);
                        }
                        
                        
                    }
                }
                catch(Exception $e)
                {
                	phpAlertDeclinado ("Error al insertar 303".$e->getMessage());
                }
                
                $BaseDeDatos->close();


                
                
            }
            else{
              phpAlertDeclinado("Debe poner fecha.");  
                
            }
            
        }
        else{
            phpAlertDeclinado("El detalle de la noticia es demasiado largo o no puso algo.");
            
        }
        
        
    }
    else{
        phpAlertDeclinado("El nombre de la noticia debe contener algo.");
        
    }
/**/
function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/noticia";   </script>';
    
}
function phpAlertContinua($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");      </script>';
    
}


?>