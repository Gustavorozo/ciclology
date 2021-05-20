<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Marca.php";
	$fecha=date("Y-m-d");
	$idusuario=$_SESSION['iduser'];
	$marca=$_POST['marca'];


$datos=array(
    $idusuario,
    $marca,
    $fecha
				);

	$obj= new Marca();

	echo $obj->agregaMarca($datos);


 ?>