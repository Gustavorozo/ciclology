<?php
session_start();
if(isset($_SESSION['usuario'])){

    ?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Color</title>
        <?php require_once "menu.php"; ?>
    </head>
    <body>

    <div class="container">
        <h1>Color</h1>
        <div class="row">
            <div class="col-sm-4">
                <form id="frmColor">
                    <label>Color</label>
                    <input type="text" class="form-control input-sm" name="Color" id="Color">
                    <p></p>
                    <span class="btn btn-primary" id="btnAgregaColor">Agregar</span>
                </form>
            </div>
            <div class="col-sm-6">
                <div id="tablaColorLoad"></div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="actualizaColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualiza Color</h4>
                </div>
                <div class="modal-body">
                    <form id="frmColorU">
                        <input type="text" hidden="" id="idcolor" name="idcolor">
                        <label>Color</label>
                        <input type="text" id="ColorU" name="ColorU" class="form-control input-sm">
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" id="btnActualizaColor" class="btn btn-warning" data-dismiss="modal">Guardar</button>

                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#tablaColorLoad').load("Color/tablaColor.php");

            $('#btnAgregaColor').click(function(){

                vacios=validarFormVacio('frmColor');

                if(vacios > 0){
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }

                datos=$('#frmColor').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/Color/agregaColor.php",
                    success:function(r){
                        if(r==1){
                            //esta linea nos permite limpiar el formulario al insertar un registro
                            $('#frmColor')[0].reset();

                            $('#tablaColorLoad').load("Color/tablaColor.php");
                            alertify.success("Color agregado con exito :D");
                        }else{
                            alertify.error("No se pudo agregar el Color");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnActualizaColor').click(function(){

                datos=$('#frmColorU').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/Color/actualizaColor.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaColorLoad').load("Color/tablaColor.php");
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
        function agregaDato(idcolor,Color){
            $('#idcolor').val(idcolor);
            $('#ColorU').val(Color);
        }

        function eliminaColor(idcolor){
            alertify.confirm('??Desea eliminar este color?', function(){
                $.ajax({
                    type:"POST",
                    data:"idcolor=" + idcolor,
                    url:"../procesos/Color/eliminarColor.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaColorLoad').load(" Color/tablaColor.php");
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