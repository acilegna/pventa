
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="" maxlength="50" required="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos</label>
                        <div class="col-sm-12">
                            <input id="apellidos" name="apellidos" required="" placeholder="" class="form-control"></input>
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telefono</label>
                        <div class="col-sm-12">
                            <input id="telefono" name="telefono" required="" placeholder="" class="form-control"></input>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Direccion</label>
                        <div class="col-sm-12">
                            <input id="direccion" name="direccion" required="" placeholder="" class="form-control"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar cambios
                             </button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
