<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Color.php";

	$obj= new Color();


	$idart=$_POST['idart'];

	echo json_encode($obj->obtenDatosColor($idart));

 ?>