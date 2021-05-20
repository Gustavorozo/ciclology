<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Marca.php";

	

	$datos=array(
		$_POST['idmarca'],
		$_POST['MarcaU']
			);

	$obj= new Marca();

	echo $obj->actualizaMarca($datos);

 ?>