<?php
       
    function consultaUnaColumnaRestriccion($ColumnaPrimera, $Restriccion,$Tabla,$ColumnaRestriccion){
            $EjecucionRetornar ="SELECT ".$ColumnaPrimera." FROM ".$Tabla." where ".$ColumnaRestriccion." = '".$Restriccion."'";
            
            
             return $EjecucionRetornar;
        }
        
    function consultaUnaColumna($ColumnaPrimera,$Tabla){
            $EjecucionRetornar = "SELECT ".$ColumnaPrimera." FROM ".$Tabla ;
            
            
            return $EjecucionRetornar;

        }
        
    function borrarDatos($Tabla,$RestriccionCondicion,$DatoEliminar){
            $EjecucionRetornar = "DELETE FROM ".$Tabla." WHERE ".$RestriccionCondicion."='".$DatoEliminar."';";
            
            
            return $EjecucionRetornar;
            
        }
        //
    function datosServicios($Tabla,$ListaFilas,$DatoRestriccion){
            $EjecucionRetornar = "SELECT  ".$ListaFilas."    FROM $Tabla where nombre ='".$DatoRestriccion."';";
            
            
            return $EjecucionRetornar;
            
        }
        
        
        
     function callProcedures($NombreProcedimiento,$ListaFilas){
            $EjecucionRetornar = "CALL ".$NombreProcedimiento." (".$ListaFilas.");";
            
            
            return $EjecucionRetornar;
            
        }

        
        
    ?>