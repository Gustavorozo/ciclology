<?php 


require_once "../../clases/Conexion.php";
require_once "../../clases/Producto.php";
$idart=$_POST['idProducto'];

	$obj=new Producto();

	echo $obj->eliminaProducto($idart);

 ?>