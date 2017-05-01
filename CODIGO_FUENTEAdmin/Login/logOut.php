<?php

try
    {
        
                $cookie_name = "user";
                $cookie_value = crypt("no","Secreta");
	            setcookie($cookie_name, $cookie_value, time() + (60 * 30), "/"); 
                $ConteoFilas = "Usuario correctamente retirado.";
                
                phpAlert( $ConteoFilas);
    }
            
        

catch(Exception $e)
    {
    	phpAlert ("Error al igresar 310".$e->getMessage());
    }
    

function phpAlert($msg) {
    echo '<meta charset="UTF-8"> <script type="text/javascript">alert("' . $msg . '");   window.location.href = "https://centroeducativoelroble-josegarita.c9users.io/AdminPanel/Login/index.html";   </script>';
    
}

?>