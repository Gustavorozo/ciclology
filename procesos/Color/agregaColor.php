<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Color.php";
$fecha=date("Y-m-d");
$idusuario=$_SESSION['iduser'];
$Color=$_POST['Color'];

$datos=array(
    $idusuario,
    $Color,
    $fecha
);

$obj= new Color();

echo $obj->agregaColor($datos);


?>
