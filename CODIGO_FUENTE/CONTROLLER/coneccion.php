<?php
    
    
    function coneccion(){
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "c9";
            $dbport = 3306;
        
            // Create connection
            
            $db = new mysqli($servername, $username, $password, $database, $dbport);
            $db->query('SET NAMES utf8');
            if ($db->connect_error) 
            {
                //echo ("Connección fallida: " . $db->connect_error);
            } 
           
            
            return $db;
        }
    ?>