<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";

	$obj= new articulos();

	$datos=array();
	
	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;

	$datosImg=array(
		$_POST['categoriaSelect'],
        $_POST['ColorSelect'],
        $_POST['MarcaSelect'],
		$nombreImg,
		$rutaFinal
					);

		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
				$idimagen=$obj->agregaImagen($datosImg);

				if($idimagen > 0){

					$datos[0]=$_POST['categoriaSelect'];
					$datos[1]=$idimagen;
					$datos[2]=$iduser;
                    $datos[3]=$_POST['MarcaSelect'];
                    $datos[4]=$_POST['ColorSelect'];
					$datos[5]=$_POST['Nombre'];
					$datos[6]=$_POST['descripcion'];
					$datos[7]=$_POST['cantidad'];
					$datos[8]=$_POST['precio'];
					echo $obj->insertaArticulo($datos);
				}else{
					echo 0;
				}
		}

 ?>