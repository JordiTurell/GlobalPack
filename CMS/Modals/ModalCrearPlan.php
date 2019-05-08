<div class="modal" id="ModalCrearPlan">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Crear Plan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <label for="titulo">Titulo Plan</label>
            <input type="text" placeholder="Titulo plan" id="titulo" />
        </div>
        <div class="form-group">
            <label for="titulo">Descripcion plan</label>
            <textarea id="descripcionplan" class="form-control"></textarea>
        </div>
          <div class="form-group">
              <label>Color de fondo del titulo</label>
              <input type="color" id="color" />
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="SavePlan();">Guardar</button>
      </div>

    </div>
  </div>
</div>