<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/Marca.php";
$id=$_POST['idmarca'];

$obj= new Color();
echo $obj->eliminaMarca($id);

?>