<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <!--begin::Toolbar wrapper-->
   <div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2" id="kt_toolbar">
      <!--begin::Page title-->
      <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
         <!--begin::Title-->
         <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Section: Profits Report</h1>
         <!--end::Title-->
         <!--begin::Breadcrumb-->
         <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
               <a href="<?php echo base_url('dashboard'); ?>" class="text-muted text-hover-primary">Home</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
               <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Profits Report</li>
            <!--end::Item-->
            
         </ul>
         <!--end::Breadcrumb-->
      </div>
      <!--end::Page title-->
      
      
   </div>
   <!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

   <!--begin::Row-->
   <div class="row g-5 g-xl-10">
      
      <!--begin::Col-->
      <div class="col-xl-12 mb-5 mb-xl-10">
         <!--begin::Timeline Widget 1-->
         <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
               <!--begin::Card title-->
               <h3 class="card-title align-items-start flex-column">
                  <span class="card-label fw-bold text-gray-900">My Profits Report</span>
               </h3>
               <!--end::Card title-->
               <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search..." />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTablesHome" id="dataTablesHome">
                        <thead>
                          <th>
                            Description
                          </th>
                          <th>
                            Price
                          </th>
                          <th>
                            Date
                          </th>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            
                            
                        <?php
                        if ($extratos !== false) {
                          foreach ($extratos as $extrato) {
                        ?>
                            <tr>
              
                              <td>
                                <span class="text-<?php echo ($extrato->tipo == 1) ? 'success' : 'danger'; ?>"><?php echo $extrato->mensagem; ?></span>
                              </td>
                              <td>
                                <span class="text-<?php echo ($extrato->tipo == 1) ? 'success' : 'danger'; ?>"><?php echo ($extrato->tipo == 1) ? '+' : '-'; ?> USD <?php echo number_format($extrato->valor, 2, ",", "."); ?></span>
                              </td>
                              <td>
                                <?php echo date('Y/m/d H:i:s', strtotime($extrato->data)); ?>
                              </td>
                            </tr>
                        <?php
                          }
                        }
                        ?>

                            
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                </div>


            </div>
            <!--end::Card body-->
         </div>
         <!--end::Timeline Widget 1-->
      </div>
      <!--end::Col-->
   </div>
   <!--end::Row-->

</div>
<!--begin::Content-->



            <!-- Modal -->
            <div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Invoice payments</h4>
                  </div>
                  <div class="modal-body">
                    <?php
                    if($formas_pagamento !== false){
                    ?>

                    <p>Check your ID HASH TRANSACTION</p>

                    <!-- start accordion -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      
                      <?php
                      foreach($formas_pagamento as $pagamento){
                      ?>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_<?php echo $pagamento->id;?>">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $pagamento->id;?>" aria-expanded="false" aria-controls="collapse_<?php echo $pagamento->id;?>">
                              <?php
                              if($pagamento->categoria_conta == 1){
                                echo BancoPorID($pagamento->banco);
                              }else{
                                echo 'Depósito via Bitcoin';
                              }
                              ?>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse_<?php echo $pagamento->id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $pagamento->id;?>">
                          <div class="panel-body">
                            <?php
                              if($pagamento->categoria_conta == 1){
                                echo 'Banco: '.BancoPorID($pagamento->banco).'<br />';
                                echo 'Agência: '.$pagamento->agencia.'<br />';
                                echo 'Conta: '.$pagamento->conta.'<br />';
                                if(!empty($pagamento->operacao) && !is_null($pagamento->operacao)){
                                    echo 'Op: '.$pagamento->operacao.'<br />';
                                }
                                
                                echo 'Tipo de conta: ';
                                echo ($pagamento->tipo == 1) ? 'Conta Corrente <br />' : 'Poupança <br />';

                                echo 'Documento: '.$pagamento->documento.'<br />';
                              }else{
                                echo 'Endereço Bitcoin: '.$pagamento->carteira_bitcoin;
                              }
                              ?>
                          </div>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    </div>
                    <!-- .end-accordion-->
                    <?php
                    }else{
                        echo '<div class="alert alert-danger text-center">No payment method available at the moment. Please, come back later.</div>';
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">DATE</button>
                  </div>
                </div>
              </div>
            </div>