<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Producto.php";

	$obj= new Producto();


	$idart=$_POST['idart'];

	echo json_encode($obj->obtenDatosProducto($idart));

 ?>