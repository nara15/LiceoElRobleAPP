<?php

function upload($File, $TargetDir)
{
    $Target_File = $TargetDir . $File["name"];
    
    if (file_exists($Target_File)) 
    {
        return [-1, "Sorry, file ".$File["name"]." already exists."];
    }
    else
    {
        
        if (move_uploaded_file($File["tmp_name"], $Target_File))
        {
            return [1, str_replace("/", "\\", $Target_File)];
        } 
        else 
        {
            return [-1, "Sorry, there was an error uploading your file."];
        }
    }
}


function reportarError($Msg, $cod)
{
    header('HTTP/1.1 500 Internal Server Booboo');
    header('Content-Type: application/json; Charset=UTF-8');
    $arr = array('message' => $Msg, 'code' => $cod);
    echo json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

function responder($Array)
{
   
    echo json_encode($Array, JSON_PRETTY_PRINT);
}

if ($_POST["TARGET_DIR"])
{
    if ($_FILES)
    {
        $count = 0;
        $Response_Dirs = array();
        
        foreach ($_FILES as $File)
        {
            $Res = upload($File, $_POST["TARGET_DIR"]);
            
            if ($Res[0] == 1)
            {
                $Response_Dirs[] = array("id"=>$count, "dir"=>$Res[1]);
            }
            $count++;
        }
        responder($Response_Dirs);
    }
    else
    {
        reportarError("ERROR - No hay imágenes", 1338);
    }

}
else 
{
    reportarError("ERROR - No hay ruta para guardar imágenes", 1337);
}

?>