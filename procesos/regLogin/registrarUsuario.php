<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios();

	$pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombre'],
		$_POST['usuario'],
        $_POST['Cedula'],
        $_POST['telefono'],
		$pass
				);

	echo $obj->registroUsuario($datos);

 ?>