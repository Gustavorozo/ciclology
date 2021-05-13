<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Producto.php";

	$obj= new Producto();

$datos=array();

	$nombreImg=$_FILES['Foto']['name'];
	$rutaAlmacenamiento=$_FILES['Foto']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;

	$datosImg=array(
		$_POST['CategoriaSelect'],
		$nombreImg,
		$rutaFinal
					);

		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
				$idFoto=$obj->agregaFoto($datosImg);

				if($idFoto > 0){

					$datos[0]=$_POST['CategoriaSelect'];
					$datos[1]=$idFoto;
					$datos[2]=$iduser;
					$datos[3]=$_POST['Nombre'];
					$datos[4]=$_POST['Talla'];
					$datos[5]=$_POST['IVA'];
					$datos[6]=$_POST['Precio_Base'];
					echo $obj->insertaProducto($datos);
				}else{
					echo 0;
				}
		}

 ?>