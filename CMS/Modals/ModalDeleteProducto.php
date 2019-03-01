<!-- Modal -->
<div class="modal fade" id="ModalDeleteProducto" tabindex="-1" role="dialog" aria-labelledby="ModalError" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title" style="float:left;">Eliminar Producto</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p>Estas seguro de eliminar dicho producto ?</p>
            </div>
            <div class="modal-footer">
              <input type="button" value="Si" class="btn" style="width:100px;" onclick="Eliminar();"/>
                <input type="button" value="No" class="btn" data-dismiss="modal" style="width:100px;"/>
            </div>
        </div>
    </div>
</div>