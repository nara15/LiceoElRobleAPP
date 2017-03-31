<?php

    //Include data base connection
    include_once "../CONTROLLER/coneccion.php";
    
    
    /**
     * Abstract class for image save on the server.
    **/
    abstract class AbstractImageSaver
    {
        /**
         * Abstrac method. It determined by the way images are processed.
         * $P_Files: Array of Files objects
         * $_Params_Info: Array of parameters for processing and saving each image.
         **/
        abstract protected function save($P_Files, $_Params_Info);
        
        /**
         * This methods saves a single image in the server
         * $P_FileDataArray: File objec with image attributes.
         * $P_Target_Dir: Target path in the server, for storing the image.
         * returns: the image path in the server.
         **/
        public function saveFile($P_FileDataArray, $P_Target_Dir)
        {

            $Target_File = $P_Target_Dir . basename($P_FileDataArray["name"]);
            $UploadOK = 1;
            
            if (file_exists($Target_File))
            {
                echo "\nLo lamentamos, esta imagen ya existe\n";
                http_response_code(1);
                $UploadOK = 0;
            }
            
            if ($UploadOK == 0)
            {
                echo "La imagen no fue subida\n";
            }
            else
            {
                if (move_uploaded_file($P_FileDataArray["tmp_name"], $Target_File))
                {
                    echo "\nThe file ". basename($P_FileDataArray["name"]). " has been uploaded\n";
                    return $Target_File;
                }
                else
                {
                    echo "Lo lamentamos, hubo un error interno del servidor a la hora de subir la imagen\n";
                    http_response_code(2);
                }
                
            }
            return NULL;
    
        }
    } // End ----- AbstractImageSaver
    

    /**
     * This class is in charge of saving a set of images with its corresponding descrip-
     * tions/captions.
     **/
    class GalleryImageSaver extends AbstractImageSaver
    {
        
        public function save($P_Files, $_Params_Info)
        {
            
            $Target_Dir = utf8_encode($_Params_Info["TARGET_DIR"]);
            $Captions = json_decode($_Params_Info["CAPTIONS"]);
            
            $Target_SQL = "";
            $BaseDeDatos = coneccion();
            $File_Count = count($P_Files);
            
            for ($i = 0; $i < $File_Count; $i++)
            {
               
                $File = $_FILES[$i];
                
                $Result = $this->saveFile($File, $Target_Dir);
                
                if ($Result != NULL)
                {
                    $Caption = $P_Captions[$i]["value"];
                    $Target_SQL .= "INSERT INTO galeria (direccion, detalle) VALUES ('$Result','$Caption');";
                }
                
            }
            
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
        }
    } // End --------- GalleryImageSaver



    /**
     * This class is responsible for saving a single image into the server
     **/
    class ImageSaver extends AbstractImageSaver
    {
        public function save($P_Files, $_Params_Info)
        {
            $_File = $P_Files["FILE"];
            $Target_Dir = utf8_encode($_Params_Info["TARGET_DIR"]);
            
            $this->saveFile($_File, $Target_Dir);
           
        }
    } // End ---------- ImageSaver
    
    
    
    if ($_POST["FUNCTION"])
    {
        if ($_FILES)
        {
            $Function_Name = $_POST["FUNCTION"];
            
            if (class_exists($Function_Name))
            {
                $Reflection = new ReflectionClass($Function_Name);
                $GallerySaver = $Reflection->newInstance();
                echo $GallerySaver->save($_FILES, $_POST);
            }
        }
    }
    
    

   
?>