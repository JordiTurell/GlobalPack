<div class="popup-contacte" onclick="Showcontact();">
    <span>Asesoramiento</span>
    <span><img src="/assets/iconos/ICON_INFO.png" style="width:50px; margin-top:-35px; margin-left:-10px;"/></span>
</div>
<div class="form-popup-contacto">
     <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-form">
                        <div class="title-form">
                            <h1>&#191;Necesitas ayuda?</h1>
                        </div>
                        <div class="row formulario-allpages">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Empresa" class="form-control" id="empresa" />
                                <input type="email" placeholder="Email" class="form-control" id="email" />
                                <input type="text" placeholder="Provincia" class="form-control" id="provincia" />
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Tel&#233;fono" class="form-control" id="telefono" />
                                <input type="text" placeholder="Nombre" class="form-control" id="nombre" />
                                <input type="text" placeholder="Pa&#237;s" class="form-control" id="pais" />
                            </div>
                            <div class="col-lg-12">
                                  <textarea placeholder="Escribe tu mensaje..." class="form-control" rows="5" id="mensaje"></textarea>
                            </div>
                            <div class="col-lg-12" style="padding-top:12px;">
                                <div class="row">
                                    <div class="col-lg-12 text-left">
                                        <input type="checkbox" id="terminos" />
                                        <span>He le&#237;do y acepto el aviso legal y la pol&#237;tica de privacidad.</span>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <input type="checkbox" />
                                        <span>Autorizo el env&#237;o de informaci&#243;n.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" id="error"></div>
                            <div class="col-lg-12 text-center">
                                <input type="button" class="btn" value="ENVIAR" onclick="SendMail();" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>