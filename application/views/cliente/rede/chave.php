<!--main content start-->
<section id="saque" class=" header-portada d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold w-50">Binary Key</h1>
                </div>
				
                <div class="content py-4 px-4 position-relative">

                    <div class="detalle w-100 position-relative">
                        <p class="alerta p-2 text-white text-center text-small">
                        Change the binary key and control every user on your network.
                        </p>
                        <div class="opciones pt-3 d-md-flex justify-content-evenly align-items-md-center">

                            <h6 class="m-md-0 fw-bolder">BINARY KEY</h6>

                            <div class="form-check">
                                <label class="radio-inline i-checks m-4">
                                    <input name="chave_binaria" id="chave_binaria" value="1" type="radio" <?php echo (InformacoesUsuario('chave_binaria') == 1) ? 'checked' : ''; ?>>
                                    <i></i> Left
                                </label>
                                <label class="radio-inline i-checks m-4">
                                    <input name="chave_binaria" id="chave_binaria" value="2" type="radio" <?php echo (InformacoesUsuario('chave_binaria') == 2) ? 'checked' : ''; ?>>
                                    <i></i> Right
                                </label>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!--main content end-->