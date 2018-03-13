<?php

function getDataBaseconnection(){
    $host = 'localhost';
    $dbname = $opt ;
    $username = 'root';
    $password = '';
    $dbConn = new PDO("mysq:lhost = $host; dbname = $dbname", $username, $password);
    
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);
    
    return $dbConn ;
}

?>