<?php 


require_once "../../clases/Conexion.php";
require_once "../../clases/Color.php";
$idart=$_POST['idColor'];

	$obj=new Color();

	echo $obj->eliminaColor($idart);

 ?>