<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>

	<body>
		<div class="container">
			<h1>Color</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmColor" enctype="multipart/form-data">
						<label>Color</label>
						<select class="form-control input-sm" id="ColorSelect" name="ColorSelect">
							<option value="A">Selecciona Color</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="Nombre" name="Nombre">
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" id="Descripcion" name="Descripcion">
						<label>Stock</label>
						<input type="text" class="form-control input-sm" id="Stock" name="Stock">
						<label>Estado</label>
						<input type="text" class="form-control input-sm" id="Estado" name="Estado">
						<p></p>
						<span id="btnAgregaArticulo" class="btn btn-primary">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Color</h4>
					</div>
					<div class="modal-body">
						<form id="frmColorU" enctype="multipart/form-data">
							<input type="text" id="idColor" hidden="" name="idColor">
							<label>Color</label>
							<select class="form-control input-sm" id="ColorSelectU" name="ColorSelectU">
								<option value="A">Selecciona Color</option>
								<?php 
								$sql="SELECT idColor,nombreColor
								from Color";
								$result=mysqli_query($conexion,$sql);
								?>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="NombreU" name="NombreU">
							<label>Descripcion</label>
							<input type="text" class="form-control input-sm" id="DescripcionU" name="DescripcionU">
							<label>Stock</label>
							<input type="text" class="form-control input-sm" id="StockU" name="StockU">
							<label>Estado</label>
							<input type="text" class="form-control input-sm" id="EstadoU" name="EstadoU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaColor" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

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
				url:"../procesos/articulos/obtenDatosArticulo.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#idArticulo').val(dato['id_producto']);
					$('#categoriaSelectU').val(dato['id_categoria']);
					$('#nombreU').val(dato['nombre']);
					$('#descripcionU').val(dato['descripcion']);
					$('#cantidadU').val(dato['cantidad']);
					$('#precioU').val(dato['precio']);

				}
			});
		}

		function eliminaArticulo(idArticulo){
			alertify.confirm('¿Desea eliminar este articulo?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/articulos/eliminarArticulo.php",
					success:function(r){
						if(r==1){
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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
			$('#btnActualizaarticulo').click(function(){

				datos=$('#frmArticulosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/articulos/actualizaArticulos.php",
					success:function(r){
						if(r==1){
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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
			$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");

			$('#btnAgregaArticulo').click(function(){

				vacios=validarFormVacio('frmArticulos');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmArticulos"));

				$.ajax({
					url: "../procesos/articulos/insertaArticulos.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						
						if(r == 1){
							$('#frmArticulos')[0].reset();
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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