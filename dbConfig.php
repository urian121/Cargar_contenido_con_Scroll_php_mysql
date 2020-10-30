<?php
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "permutas";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");



//DB details
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'permutas';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
} 
?>