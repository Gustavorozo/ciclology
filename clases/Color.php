


<?php

class Color{

    public function agregaColor($datos){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="INSERT into Color(id_usuario,
										nombreColor,
										fechaCaptura)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]')";

        return mysqli_query($conexion,$sql);
    }

    public function actualizaColor($datos){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="UPDATE Color set nombreColor='$datos[1]'
								where id_color='$datos[0]'";
        echo mysqli_query($conexion,$sql);
    }

    public function eliminaColor($idcolor){
        $c= new conectar();
        $conexion=$c->conexion();
        $sql="DELETE from Color 
					where id_color='$idcolor'";
        return mysqli_query($conexion,$sql);
    }

}

?>