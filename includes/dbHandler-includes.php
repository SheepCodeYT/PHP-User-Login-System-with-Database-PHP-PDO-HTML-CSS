<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "sheepcodedatabase";



// Set DSN (Data Source Name)
$dsn = "mysql:host=". $servername .";dbname=". $dBName .";charset=utf8;";

try{
    $PDOConnectionDatabase = new PDO ($dsn, $dBUsername, $dBPassword);
}catch(PDOExeption $e){
    die("Connection Error: " . $e->getMessage() );
}










