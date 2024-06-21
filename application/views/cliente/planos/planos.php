<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <!--begin::Toolbar wrapper-->
   <div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2" id="kt_toolbar">
      <!--begin::Page title-->
      <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
         <!--begin::Title-->
         <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Section: PLANS</h1>
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
            <li class="breadcrumb-item text-muted">Plans</li>
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

        <?php
        if ($this->session->userdata('message_planos')) {

            echo $this->session->userdata('message_planos');
            $this->session->unset_userdata('message_planos');
        }
        ?>  

        <?php
        if ($planos !== false) {
        
            $name = InformacoesUsuario('login');
            $ocultar = 2;
            foreach ($planos as $plano) {
                
                $idPlan = $plano->id;
                
                $valorPlan = $plano->valor;
                
                
                if($valorPlan > 0){
        ?>            
    
        <!--begin::Col-->
        <div class="col-xl-4 col-xxl-3 mb-0">
            <!--begin::Timeline Widget 1-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5 justify-content-center">
                <!--begin::Card title-->
                <h3 class="card-title align-items-start flex-row">
                    <span class="card-label fw-bold text-gray-900"><?php echo $plano->nome; ?></span>
                    <?php echo ($plano->recomendado == 1) ? '<span class="badge badge-light-success fs-base">RECOMMENDED</span>' : ''; ?>
                </h3>
                <!--end::Card title-->
                
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column flex-center pt-0">

                    <?php
								  
                    $imgPlan = $plano->img_plan;
                    
                    if($imgPlan!=""){
                        $imgPlan = $plano->img_plan;
                    }else{
                        $imgPlan = "no-image.jpg"; 
                    }
                    
                    ?>

                    <img src="<?php echo base_url();?>assets/imgs/plan/<?php echo $imgPlan;?>"  class="img-fluid imgPlanes">
                
                    <a href="<?php echo base_url()."bill/?product=". $plano->id; ?>" 
                        class="btn btn-primary fw-bold" >PURCHASE
                    </a>



                </div>
                <!--end::Card body-->
            </div>
            <!--end::Timeline Widget 1-->
        </div>
        <!--end::Col-->

        <?php
                }	
            }
        
        } else {

            ?>
            <!--begin::Col-->
            <div class="col-xl-4 col-xxl-3 mb-5 mb-xl-10">
                <!--begin::Timeline Widget 1-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">No Plans</span>
                        </h3>
                        <!--end::Card title-->
                        
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pb-0">
                        <div class="alert alert-danger text-center">We dont have any plans at the moment. Please, come back later.</div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Timeline Widget 1-->
            </div>
            <!--end::Col-->
            <?php

        }
        ?>


   </div>
   <!--end::Row-->

</div>
<!--begin::Content-->


                                    
                                    
<?php
$ocultar = 1; 
if($ocultar == 3)
{
?>
<li>- Binary <?php echo (is_null($plano->binario) || $plano->binario == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = ' . $plano->binario . '%'; ?></li>

<div class="divider"></div>                                    
<li>- Career Plan <?php echo (is_null($plano->plano_carreira) || $plano->plano_carreira == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = ' . $plano->plano_carreira . ' points'; ?></li>


<div class="divider"></div>

<li>- Affiliate Network <?php echo ($plano->rede_afiliados == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'; ?></li>
<div class="divider"></div>
<li>- Binary Earnings <?php echo (is_null($plano->teto_binario) || $plano->teto_binario == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = USD ' . number_format($plano->teto_binario, 2, ",", ".") . '/dia'; ?> </li>
<div class="divider"></div>
<li>- Daily Earnings <?php echo (is_null($plano->ganhos_diarios) || $plano->ganhos_diarios == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = USD ' . number_format($plano->ganhos_diarios, 2, ",", "."); ?> </li>
<div class="divider"></div>
<?php 
}
?>
                                