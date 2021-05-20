<?php
session_start();
if(isset($_SESSION['usuario'])){

    ?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Marca</title>
        <?php require_once "menu.php"; ?>
    </head>
    <body>

    <div class="container">
        <h1>Marca</h1>
        <div class="row">
            <div class="col-sm-4">
                <form id="frmMarca">
                    <label>Marca</label>
                    <input type="text" class="form-control input-sm" name="marca" id="marca">
                    <p></p>
                    <span class="btn btn-primary" id="btnAgregaMarca">Agregar</span>
                </form>
            </div>
            <div class="col-sm-6">
                <div id="tablaMarcaLoad"></div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="actualizaMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualiza Marca</h4>
                </div>
                <div class="modal-body">
                    <form id="frmMarcaU">
                        <input type="text" hidden="" id="idmarca" name="idmarca">
                        <label>Marca</label>
                        <input type="text" id="MarcaU" name="MarcaU" class="form-control input-sm">
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" id="btnActualizaMarca" class="btn btn-warning" data-dismiss="modal">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#tablaMarcaLoad').load("Marca/tablaMarca.php");

            $('#btnAgregaMarca').click(function(){

                vacios=validarFormVacio('frmMarca');

                if(vacios > 0){
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }

                datos=$('#frmMarca').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/Marca/agregaMarca.php",
                    success:function(r){
                        if(r==1){
                            //esta linea nos permite limpiar el formulario al insertar un registro
                            $('#frmMarca')[0].reset();

                            $('#tablaMarcaLoad').load("Marca/tablaMarca.php");
                            alertify.success("Marca agregada con exito :D");
                        }else{
                            alertify.error("No se pudo agregar la Marca");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnActualizaMarca').click(function(){

                datos=$('#frmMarcaU').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/Marca/actualizaMarca.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaMarcaLoad').load("Marca/tablaMarca.php");
                            alertify.success("Actualizado con exito :)");
                        }else{
                            alertify.error("no se pudo actaulizar :(");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function agregaDato(idMarca,Marca){
            $('#idmarca').val(idMarca);
            $('#MarcaU').val(Marca);
        }

        function eliminarMarca(idmarca){
            alertify.confirm('¿Desea eliminar esta marca?', function(){
                $.ajax({
                    type:"POST",
                    data:"idmarca=" + idmarca,
                    url:"../procesos/Marca/eliminarMarca.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaMarcaLoad').load("Marca/tablaMarca.php");
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
    <?php
}else{
    header("location:../index.php");
}
?>
