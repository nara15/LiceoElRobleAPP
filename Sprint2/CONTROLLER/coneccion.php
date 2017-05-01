<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    //mysql-ctl install
    
    
    
    function coneccion(){
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "c9";
            $dbport = 3306;
        
            // Create connection
            $db = new mysqli($servername, $username, $password, $database, $dbport);
        
            // Check connection
            if ($db->connect_error) {
                //echo ("Connección fallida: " . $db->connect_error);
            } 
            //echo "Conectado Correctamente a la base de datos (".$db->host_info.")";
            
            return $db;
        }
    ?>