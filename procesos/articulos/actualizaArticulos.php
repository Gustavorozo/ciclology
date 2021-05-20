<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj= new articulos();

$datos=array(
		$_POST['idArticulo'],
	    $_POST['categoriaSelectU'],
        $_POST['MarcaSelectU'],
        $_POST['ColorSelectU'],
	    $_POST['NombreU'],
	    $_POST['descripcionU'],
	    $_POST['cantidadU'],
	    $_POST['precioU']
			);

    echo $obj->actualizaArticulo($datos);

 ?>