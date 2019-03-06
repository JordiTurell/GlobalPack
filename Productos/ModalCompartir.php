<!-- Modal -->
<div id="ModalCompartir" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" style="float:left;">Compartir</h4>
        <button type="button" class="close" data-dismiss="modal" style="float:right;">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="compartir-list">
            <li>
                <img src="/assets/iconos/facebook.png"  onclick="SharedFacebook();"/>
            </li>
            <li>
                <img src="/assets/iconos/tweeter.png"  onclick="SharedTweeter();"/>
            </li>
            <li>
                <img src="/assets/iconos/linkedin.png" onclick="SharedLinkedin();"/>
            </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>