<?php

$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "c9";


try {
    //$conn = new PDO("mysql:host=$servername;dbname=c9", $username, $password);
    $conn = new mysqli($servername, $username, $password, $dbname);
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


try
{

    mysqli_select_db($conn,"c9");
    $sql = "SELECT detalle, contenido FROM informacion";
    $result = $conn->query($sql);
    
    $res = array();
    
    if ($result->num_rows > 0) 
    {
    
        while($row = mysqli_fetch_assoc($result)/*$row = $result->fetch_assoc()*/) 
        {
            //echo "Con: " . $row["detalle"]. "---". $row["contenido"] . "<br>";
            $cont = utf8_encode($row["contenido"]);
            $res[] = array($row["detalle"] => $cont);
            
           

        }
        $json = json_encode($res);
        echo $json;
        
      
    } 
    else 
    {
        echo "0 results";
    }

}
catch(Exception $e)
{
	die($e->getMessage());
}


?>