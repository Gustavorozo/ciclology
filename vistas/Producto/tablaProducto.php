
<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT art.Nombre,
					art.Talla,
					art.IVA,
					art.precio_Base,
					img.ruta,
					cat.nombreCategoria,
					art.idProducto
		  from Producto as art 
		  inner join foto as img
		  on art.idFoto=img.idFoto
		  inner join Categorias as cat
		  on art.idCategoria=cat.id_categoria";
	$result=mysqli_query($conexion,$sql);

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Producto</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Talla</td>
		<td>Cantidad</td>
		<td>Precio_Base</td>
		<td>Foto</td>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td>
			<?php 
			$imgVer=explode("/", $ver[4]) ; 
			$imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
			?>
			<img width="80" height="80" src="<?php echo $imgruta ?>">
		</td>
		<td><?php echo $ver[5]; ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateProducto" class="btn btn-warning btn-xs" onclick="agregaDatosProducto('<?php echo $ver[6] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaProducto('<?php echo $ver[6] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>