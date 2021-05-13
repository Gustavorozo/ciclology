

<?php 
	class Producto{
		public function agregaFoto($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into Foto (idColor,
										nombre,
										ruta,
										fechaSubida)
							values ('$datos[0]',
									'$datos[1]',
							        '$datos[2]',
									'$fecha')";
			$result=mysqli_query($conexion,$sql);

			return mysqli_insert_id($conexion);
		}
		public function insertaProducto($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into Producto (idProducto,
										idFoto,
										id_usuario,
                                        idMarca,
										Nombre,
										Talla,
										IVA,
										Precio_Base,
										fechaCaptura) 
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
									'$datos[5]',
									'$datos[6]',
							        '$datos[8]',
									'$fecha')";
			return mysqli_query($conexion,$sql);
		}

		public function obtenDatosProducto($idProducto){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT idProducto, 
						idCategoria, 
						Nombre,
						Talla,
						IVA,
						Precio_Base 
				from Producto 
				where idProducto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					"idProducto" => $ver[0],
					"idCategoria" => $ver[1],
					"Nombre" => $ver[2],
					"Talla" => $ver[3],
					"IVA" => $ver[4],
					"Precio_Base" => $ver[5]
						);

			return $datos;
		}

		public function actualizaProducto($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE Producto set idCategoria='$datos[1]', 
										Nombre='$datos[2]',
										Talla='$datos[3]',
										IVA='$datos[4]',
										Precio_Base='$datos[5]'
						where idProducto='$datos[0]'";

			return mysqli_query($conexion,$sql);
		}

		public function eliminaProducto($idProducto){
			$c=new conectar();
			$conexion=$c->conexion();

			$idFoto=self::obtenIdImg($idProducto);

			$sql="DELETE from Producto 
					where idProducto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			if($result){
				$ruta=self::obtenRutaImagen($idFoto);

				$sql="DELETE from Foto 
						where idFoto='$idFoto'";
				$result=mysqli_query($conexion,$sql);
					if($result){
						if(unlink($ruta)){
							return 1;
						}
					}
			}
		}

		public function obtenIdImg($idProducto){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT idFoto
					from Producto
					where idProducto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from Foto 
					where idFoto='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

	}

 ?>