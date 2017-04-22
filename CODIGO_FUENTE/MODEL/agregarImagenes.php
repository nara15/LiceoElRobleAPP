<?php
    //Include data base connection
    include_once "../CONTROLLER/coneccion.php";

   $str_json = file_get_contents('php://input');
   
   $response = json_decode($str_json, true);
   
   $Target_SQL = "";
   
   foreach($response as $item) 
   { 
       $Dir = str_replace("\\", "/",$item['dir'] );
       $Caption = $item['caption'];
       $Target_SQL .= "INSERT INTO galeria (direccion, detalle) VALUES ('$Dir','$Caption');";
    }
    
    $BaseDeDatos = coneccion();
    if (strlen($Target_SQL) > 0)
    {
        if ($BaseDeDatos->multi_query($Target_SQL) === TRUE) 
        {
            echo "New records created successfully";
            
        } else {
            echo "Error: " . $Target_SQL . "<br>" . $BaseDeDatos->error;
        }
    }
    
    $BaseDeDatos->close();

?>