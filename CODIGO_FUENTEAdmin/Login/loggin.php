<?php

include_once "../../CONTROLLER/coneccion.php";
include_once "../../CONTROLLER/SQLComandos.php";


$user=$_POST['user'];
$pass=$_POST['pass'];


$BaseDeDatos = coneccion();
try
    {
        if(0 < strlen($user) and 0 < strlen($pass) ){
            mysqli_select_db($BaseDeDatos,"c9");
                            //
            $SqlSelectServicios = callProcedures("verificarPass", " '".$user."' , '".$pass."'" );
            //
            $ResultadoEjecucion = $BaseDeDatos->query($SqlSelectServicios);
            
            $ResultadoRetornar = array();
            if ($ResultadoEjecucion->num_rows > 0 ) 
            {
                $cookie_name = "user";
                $cookie_value = crypt("si","Secreta");
	            setcookie($cookie_name, $cookie_value, time() + (60 * 30), "/"); 
	            setcookie("nombre", crypt($user,"Usuario"), time() + (60 * 30), "/"); 
                $ConteoFilas = "Usuario verificado, procediendo a redireccionamiento.";
                
                phpAlertConfirmado( $ConteoFilas);
            } 
            else 
            {
                $ConteoFilas = "Error, contraseña o usuario no válido.";
            
                phpAlertDeclinado( $ConteoFilas);
                
            }
            
            
            
            // phpAlert($SqlSelectServicios);
            
        }
        else{
            phpAlertDeclinado("Contraseña o Usuario inválido.");
            
}
}
catch(Exception $e)
    {
    	phpAlertDeclinado ("Error al igresar 310".$e->getMessage());
    }
    
$BaseDeDatos->close();

function phpAlertDeclinado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}
function phpAlertConfirmado($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/index.php#!/";   </script>';
    
}
?>