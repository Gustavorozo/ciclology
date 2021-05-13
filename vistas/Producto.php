<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Producto</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
		$c= new conectar();
		$conexion=$c->conexion();
		$sql="SELECT idProducto,nombreCategoria
		from categorias";
		$result=mysqli_query($conexion,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Producto</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProducto" enctype="multipart/form-data">
						<label>Producto</label>
						<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
							<option value="A">Selecciona Categoria</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="Nombre" name="Nombre">
						<label>Talla</label>
						<input type="text" class="form-control input-sm" id="Talla" name="Talla">
						<label>IVA</label>
						<input type="number" class="form-control input-sm" id="IVA" name="IVA">
						<label>Precio_Base</label>
						<input type="number" class="form-control input-sm" id="Precio_Base" name="Precio_Base">
						<label>Foto</label>
						<input type="file" id="Foto" name="Foto">
						<p></p>
						<span id="btnAgregaProducto" class="btn btn-primary">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaProductoLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Producto</h4>
					</div>
					<div class="modal-body">
						<form id="frmProductoU" enctype="multipart/form-data">
							<input type="text" id="idProducto" hidden="" name="idProducto">
							<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
								<option value="A">Selecciona Categoria</option>
								<?php 
								$sql="SELECT id_categoria,nombreCategoria
								from categorias";
								$result=mysqli_query($conexion,$sql);
								?>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Talla</label>
							<input type="text" class="form-control input-sm" id="TallaU" name="TallaU">
							<label>IVA</label>
							<input type="number" class="form-control input-sm" id="cantidadU" name="cantidadU">
							<label>Precio_Base</label>
							<input type="number" class="form-control input-sm" id="Precio_BaseU" name="Precio_BaseU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaProducto" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosArticulo(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../procesos/Producto/obtenDatosProducto.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#idProducto').val(dato['idProducto']);
					$('#categoriaSelectU').val(dato['id_categoria']);
					$('#NombreU').val(dato['Nombre']);
					$('#TallaU').val(dato['Talla']);
					$('#IVAU').val(dato['IVA']);
					$('#Precio_BaserecioU').val(dato['Precio_Base']);

				}
			});
		}

		function eliminaProducto(idProducto){
			alertify.confirm('¿Desea eliminar este Producto?', function(){
				$.ajax({
					type:"POST",
					data:"idProducto=" + idProducto,
					url:"../procesos/Producto/eliminarProducto.php",
					success:function(r){
						if(r==1){
							$('#tablaProductoLoad').load("Producto/tablaProducto.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaProducto').click(function(){

				datos=$('#frmProductoU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/Producto/actualizaProducto.php",
					success:function(r){
						if(r==1){
							$('#tablaProductoLoad').load("Producto/tablaProducto.php");
							alertify.success("Actualizado con exito :D");
						}else{
							alertify.error("Error al actualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaProductoLoad').load("Producto/tablaProducto.php");

			$('#btnAgregaProducto').click(function(){

				vacios=validarFormVacio('frmProducto');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmProducto"));

				$.ajax({
					url: "../procesos/Producto/insertaProducto.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						
						if(r == 1){
							$('#frmProducto')[0].reset();
							$('#tablaProductoLoad').load("Producto/tablaProducto.php");
							alertify.success("Agregado con exito :D");
						}else{
							alertify.error("Fallo al subir el archivo :(");
						}
					}
				});
				
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>