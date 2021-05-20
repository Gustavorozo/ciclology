<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Color.php";

	

	$datos=array(
		$_POST['idcolor'],
		$_POST['ColorU']
			);

	$obj= new Color();

	echo $obj->actualizaColor($datos);

 ?>