

<?php
class Color{
    public function agregaColor($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $fecha=date('Y-m-d');

    public function insertaColor($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $fecha=date('Y-m-d');

        $sql="INSERT into Color (IdProducto,
										Nombre,
										Descripcion,
										Stock,
										Estado) 
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]
									')";
        return mysqli_query($conexion,$sql);
    }

    public function obtenDatosColor($idarticulo){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="SELECT IdProducto, 
						Nombre,
						Descripcion,
						Stock,
					    Estado
				from Color
				where IdProducto='$idarticulo'";
        $result=mysqli_query($conexion,$sql);

        $ver=mysqli_fetch_row($result);

        $datos=array(
            "IdProducto" => $ver[0],
            "Nombre" => $ver[1],
            "Descripcion" => $ver[2],
            "Stock" => $ver[3],
            "Estado" => $ver[4]
        );

        return $datos;
    }

    public function actualizaColor($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="UPDATE articulos set  
										Nombre='$datos[1]',
										Descripcion='$datos[2]',
										Stock='$datos[3]',
										Estado='$datos[4]'
						where IdProducto='$datos[0]'";

        return mysqli_query($conexion,$sql);
    }

    public function eliminaColor($idColor){
        $c=new conectar();
        $conexion=$c->conexion();


        $sql="DELETE from Color 
					where IdProducto='$idColor'";
        $result=mysqli_query($conexion,$sql);




        }
    }








}

?>