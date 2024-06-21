<style>
html:before {
    content: '';
    width: 100vw;
    height: 100%;
    background: #000000;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
    opacity: 0.7;
}

</style>


<!--main content start-->
<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-3 my-auto">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold w-50">Binary NetWork</h1>
                </div>
                

            </div>
        </div>
    </div>
</section>
<!--main content end-->


<!--main content start-->
<div id="content" class="ui-content network-bg">
    <div class="ui-content-body">
        <div class="ui-container">
           

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          <a class="btn btn-primario" href="<?php echo base_url('network');?>"><i class="fa fa-arrow-left"></i> Back to my Network</a>
                          
                          <?php
                          if($nivel_acima !== false){
                          ?>
                          <a class="btn btn-primario pull-right" href="<?php echo base_url();?>network<?php echo (InformacoesUsuario('id') != $nivel_acima) ? '?network_id='.$nivel_acima : '';?>"><i class="fa fa-arrow-up"></i> Go back one Level</a>
                          
                          <div class="clearfix"></div>
                          <br />
                          <?php
                          }
                          ?>

                            <div class="">
                              <?php
                              if(!empty($matriz) && !is_null($matriz)){
                              ?>
                              <ul id="org" style="display:none">
                                  <center><?php echo $matriz; ?></center>    
                              </ul>
                              <div id="chart" class="orgChart"></div>
                              <?php
                              }else{
                                echo '<div class="alert alert-danger text-center">Sorry, this network is not available to you.</div>';
                              }
                              ?>
                            </div>
                      </div>
                  </section>
              </div>

          </div>

        </div>

    </div>
</div>
<!--main content end-->