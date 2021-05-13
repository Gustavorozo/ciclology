<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Color.php";

$obj= new Color();

$datos=array(
		$_POST['idColor'],
	    $_POST['NombreU'],
	    $_POST['DescripcionU'],
	    $_POST['StockU'],
	    $_POST['EstadoU']
			);

    echo $obj->actualizaColor($datos);

 ?>