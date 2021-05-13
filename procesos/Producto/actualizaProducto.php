<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Producto.php";

$obj= new Producto();

$datos=array(
		$_POST['idProducto'],
	    $_POST['CategoriaSelectU'],
	    $_POST['NombreU'],
	    $_POST['TallaU'],
	    $_POST['IVAU'],
	    $_POST['precio_BaseU']
			);

    echo $obj->actualizaProducto($datos);

 ?>