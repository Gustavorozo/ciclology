


<?php

class Marca{

    public function agregaMarca($datos){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="INSERT into Marca(id_usuario,
										nombreMarca,
										fechaCaptura)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]')";

        return mysqli_query($conexion,$sql);
    }

    public function actualizaMarca($datos){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="UPDATE Marca set nombreMarca='$datos[1]'
								where id_marca='$datos[0]'";
        echo mysqli_query($conexion,$sql);
    }

    public function eliminaMarca($idmarca){
        $c= new conectar();
        $conexion=$c->conexion();
        $sql="DELETE from Marca 
					where id_marca='$idmarca'";
        return mysqli_query($conexion,$sql);
    }

}

?>