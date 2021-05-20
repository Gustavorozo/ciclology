<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Color.php";
	$id=$_POST['idcolor'];

	$obj= new Color();
	echo $obj->eliminaColor($id);

 ?>