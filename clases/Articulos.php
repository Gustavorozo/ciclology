

<?php 
	class articulos{
		public function agregaImagen($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into imagenes (id_categoria,
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
		public function insertaArticulos($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into articulos (id_categoria,
										id_imagen,
										id_usuario,
                                        id_marca,
                                        id_Color,
										Nombre,
										descripcion,
										cantidad,
										precio,
										fechaCaptura) 
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
									'$datos[5]',
									'$datos[6]',
							        '$datos[7]',
							        '$datos[8]',
									'$fecha')";
			return mysqli_query($conexion,$sql);
		}

		public function obtenDatosArticulo($idarticulo){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_producto, 
						id_categoria,
                        id_marca,
                        id_color,
						Nombre,
						descripcion,
						cantidad,
						precio 
				from articulos 
				where id_producto='$idarticulo'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					"id_producto" => $ver[0],
					"id_categoria" => $ver[1],
					"id_marca" => $ver[2],
                    "id_color" => $ver[3],
					"Nombre" => $ver[4],
					"descripcion" => $ver[5],
					"cantidad" => $ver[6],
					"precio" => $ver[7]
						);

			return $datos;
		}

		public function actualizaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE articulos set id_categoria='$datos[1]', 
                                       id_marca='$datos[2]',
                                       id_color='$datos[3]',
										Nombre='$datos[4]',
										descripcion='$datos[5]',
										cantidad='$datos[6]',
										precio='$datos[7]'
						where id_producto='$datos[0]'";

			return mysqli_query($conexion,$sql);
		}

		public function eliminaArticulo($idarticulo){
			$c=new conectar();
			$conexion=$c->conexion();

			$idimagen=self::obtenIdImg($idarticulo);

			$sql="DELETE from articulos 
					where id_producto='$idarticulo'";
			$result=mysqli_query($conexion,$sql);

			if($result){
				$ruta=self::obtenRutaImagen($idimagen);

				$sql="DELETE from imagenes 
						where id_imagen='$idimagen'";
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

			$sql="SELECT id_imagen 
					from articulos 
					where id_producto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from imagenes 
					where id_imagen='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

	}

 ?>