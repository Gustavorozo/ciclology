<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios;

	$datos=array(
			$_POST['idUsuario'],  
		    $_POST['nombreU'] , 
		    $_POST['CedulaU'],
            $_POST['telefonoU'],
		    $_POST['usuarioU']
				);  
	echo $obj->actualizaUsuario($datos);


 ?>