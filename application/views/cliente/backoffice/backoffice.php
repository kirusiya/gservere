<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <!--begin::Toolbar wrapper-->
   <div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2 mb-n10" id="kt_toolbar">
      <!--begin::Page title-->
      <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
         <!--begin::Title-->
         <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
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
            <li class="breadcrumb-item text-muted">Dashboard</li>
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


    <?php
    /*test*/
    $condicional = 1;

    $id_user_cal = $this->session->userdata('uid'); 
                                
    $calificadores =  misReferidosDirectosCalificadores($id_user_cal);
    //print_r($calificadores);
    $contBinarios = 0;

    $restDirectos="";

    if($calificadores){
        
        foreach ($calificadores as $calificador){

            $binary = $calificador->chave_binaria;
            //echo "<br>".$calificador->id_usuario ." b ".$binary;

            if($binary==1){
                $contBinarios++;
                $restDirectos.="";
            }

            if($binary==2){
                $contBinarios++;
            }  



        }
        
    }	
                                
    //echo "<br>** binarios: ".$contBinarios;

    if($contBinarios>=2){
        
        //do code example of use
        
    }
    /*test*/


    /*ver mi pierna derrame*/
    $idUserRed = $this->session->userdata('uid'); 
    $ladoNetIns =  verLadoPatroDirecto($idUserRed);
                                
    $ladoNetworkIns = $ladoNetIns[0]->chave_binaria;

    //echo "<br>".$ladoNetIns[0]->chave_binaria;
    //echo "<br>".$ladoNetIns[0]->id_usuario;
    //echo "<br>".$ladoNetIns[0]->id_patrocinador_direto;
    /*ver mi pierna derrame*/


    /*fix all max 300% all users*/
    $maxGananciaFixed = consultaPlanGanancias(InformacoesUsuario('id'));

    $rendimientos = InformacoesUsuario('saldo_rendimentos');
    $referidosGanancia = InformacoesUsuario('saldo_indicacoes');
    $binariosdiaGanancia = InformacoesUsuario('binarios_dia');
    /*fix all max 300% all users*/




    $idUserRed = $this->session->userdata('uid'); 
    $plansThree =  usersLastThree($idUserRed);

    $maxGananciaThree = 0;
    if($plansThree){
        
        foreach($plansThree as $plansAll){
            
            
            //echo "<br>nombre: ".$plansAll->nome." valor: ".$plansAll->valor." max".$plansAll->ganhos_maximo;
            
            $maxGananciaThree += $plansAll->ganhos_maximo;
            
            
        }
        
        
    }


    $maxGananciaThree = $maxGananciaThree;


    ?>

    <!-- notification -->
    <div class="row gx-5 gx-xl-10 mb-7" id="notiSystem">

        <div class="col-xl-12">
            <div class="card card-flush ">

                  <!--begin::Body-->
                  <div class="card-body py-6 pt-5">

                    <!-- notificaciones -->
                    <?php
                    $ip = $_SERVER['REMOTE_ADDR'];
                    countryDetected(InformacoesUsuario('id'), $ip);
                    ?>
                    <!--== Notifications ==-->
                    <?php
                    if($this->UsuarioModel->MinhasNotificacoes() !== false){
                        $contNoti = 0;
                        foreach($this->UsuarioModel->MinhasNotificacoes() as $notificacao){
                            $contNoti++;
                            if($contNoti==1){
                    ?>
                    <div class="p-3 text-center" >
                        <div class="content style-content py-4 px-4 position-relative">

                            <div class="detalle position-relative w-100">

                                <div class="text-end">
                                    <h2>SGI <?php echo lang('title_dialog1')?> <span id="closeNoti"><i class="fas fa-times-circle"></i></span></h2>
                                    <div class="linea"></div>
                                </div>
                                
                                <div class="col-12 mt-3">
                                    
                                    <?php
                                    $imgNoti = strlen($notificacao->icone);
                                    
                                    if($imgNoti<8){
                                        $imgNotiIcon = "logo-web.png";
                                    }else{								
                                        $imgNotiIcon = $notificacao->icone;
                                        echo "<style>img.imgNotificaciones1 {
                                            content:url(".base_url()."assets/imgs/plan/".$notificacao->icone.");
                                            display: block;
                                            margin: 0 auto;
                                            padding-top: 15px;
                                            padding-bottom: 25px;
                                            width: 100%;
                                        }</style>";
                                        if($notificacao->icone2!=''){
                                            echo "<style>@media (max-width : 767px){	
                                                .copyLinkHome{
                                                    margin-top: 20px;
                                                }
                                                
                                                img.imgNotificaciones1 {
                                                    content:url(".base_url()."assets/imgs/plan/".$notificacao->icone2.");
                                                    object-fit: cover; /* Recorta la imagen sin deformarla */
                                                    object-position: center;
                                                }
                                            }</style>";
                                        }
                                    }
                                    if($imgNoti<8){ ?>
                                        <img src="<?php echo base_url();?>assets/imgs/plan/<?php echo $imgNotiIcon;?>"
                                        class="imgNotificaciones">
                                    <?php } ?>
                                    
                                    <img class="imgNotificaciones1">
                                
                                    <p><?php echo $notificacao->mensagem;?></p>
                                    <!--<p><?php //echo lang('welcome_dialog1')?></p>-->
                                    <small><?php echo TempoAtras(strtotime($notificacao->data));?></small>
                                
                                </div>
                                
                            </div>	
                        </div>
                    </div>
                    <?php
                            
                                
                            }	
                            
                        }
                    }
                    ?>    

                    <!-- notificaciones -->

                  </div>



            </div>
        </div>
    

    </div>
    <!-- notification -->

   <!--begin::Row-->
   <div class="row gx-5 gx-xl-10">
      <!--begin::Col-->
      <div class="col-xl-4 mb-10">
         <!--begin::Lists Widget 19-->
         <div class="card card-flush h-xl-100 earnings">
            <!--begin::Heading-->
            <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-200px" style="background-image:url('<?php echo base_url(); ?>/assets2/assets/media/svg/shapes/top-green.png" data-bs-theme="light">
               <!--begin::Title-->
               <h3 class="card-title align-items-start flex-column text-white pt-7">
                  <span class="fw-bold fs-2x mb-3">My Earnings</span>
                  
               </h3>
               <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Body-->
            <div class="card-body mt-n20">
               <!--begin::Stats-->
               <div class="mt-n20 position-relative">
                  <!--begin::Row-->
                  <div class="row g-3 g-lg-6">
                     <!--begin::Col-->
                     <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                           <!--begin::Symbol-->
                           <div class="symbol symbol-30px me-5 mb-8">
                              <span class="symbol-label">
                                <i class="fas fa-comment-dollar"></i>
                              </span>
                           </div>
                           <!--end::Symbol-->
                           <!--begin::Stats-->
                           <div class="m-0">
                                <?php 
								
								//echo number_format(InformacoesUsuario('saldo_rendimentos'), 2, ",", "."); 
								$saldoRend = InformacoesUsuario('saldo_rendimentos');
								$binarios_dia = InformacoesUsuario('binarios_dia');
								$profits = $saldoRend;
								
								if($profits<0){
									$profits = 0;
								}
								$daily_bonus = number_format($profits, 2, ",", ".");
								
								?>   

                              <!--begin::Number-->
                              <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><?php echo $daily_bonus; ?> USD</span>
                              <!--end::Number-->
                              <!--begin::Desc-->
                              <span class="text-gray-500 fw-semibold fs-6">Daily bonus</span>
                              <!--end::Desc-->
                           </div>
                           <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                           <!--begin::Symbol-->
                           <div class="symbol symbol-30px me-5 mb-8">
                              <span class="symbol-label">
                                <i class="fas fa-comment-dollar"></i>
                              </span>
                           </div>
                           <!--end::Symbol-->
                           <!--begin::Stats-->
                           <div class="m-0">
                              <!--begin::Number-->
                              <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                
                                <?php 
								
								//echo number_format(InformacoesUsuario('saldo_rendimentos'), 2, ",", "."); 
								$binarios_dia = InformacoesUsuario('binarios_dia');
								
								if($binarios_dia<0){
									$binarios_dia = 0;
								}
								
								echo number_format($binarios_dia, 2, ",", "."). " USD"; 
								?> 

                              </span>
                              <!--end::Number-->
                              <!--begin::Desc-->
                              <span class="text-gray-500 fw-semibold fs-6">Binary</span>
                              <!--end::Desc-->
                           </div>
                           <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                           <!--begin::Symbol-->
                           <div class="symbol symbol-30px me-5 mb-8">
                              <span class="symbol-label">
                                <i class="fas fa-project-diagram"></i>
                              </span>
                           </div>
                           <!--end::Symbol-->
                           <!--begin::Stats-->
                           <div class="m-0">
                              <!--begin::Number-->
                              <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                <?php echo number_format(InformacoesUsuario('saldo_indicacoes'), 2, ",", "."); ?> USD  
                              </span>
                              <!--end::Number-->
                              <!--begin::Desc-->
                              <span class="text-gray-500 fw-semibold fs-6">Referral Bonus</span>
                              <!--end::Desc-->
                           </div>
                           <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                           <!--begin::Symbol-->
                           <div class="symbol symbol-30px me-5 mb-8">
                              <span class="symbol-label">
                                <i class="fas fa-network-wired"></i>
                              </span>
                           </div>
                           <!--end::Symbol-->
                           <!--begin::Stats-->
                           <div class="m-0">
                              <!--begin::Number-->
                              <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                <?php echo $rede; ?><br>Users
                              </span>
                              <!--end::Number-->
                              <!--begin::Desc-->
                              <span class="text-gray-500 fw-semibold fs-6">My Network</span>
                              <!--end::Desc-->
                           </div>
                           <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                     </div>
                     <!--end::Col-->
                  </div>
                  <!--end::Row-->
               </div>
               <!--end::Stats-->
            </div>
            <!--end::Body-->
         </div>
         <!--end::Lists Widget 19-->
      </div>
      <!--end::Col-->
      <!--begin::Col-->
      <div class="col-xl-8 mb-10">
         <!--begin::Row-->
         <div class="row g-5 g-xl-5">

            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">Network</span>
                     </h4>
                     <!--end::Title-->
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">
                         
                        <div class="table-responsive">        

                            <table class="table table-row-dashed text-center align-middle headerCustom">
                                <thead class="">
                                    <tr>
                                        <!--<th>#</th>-->
                                        <!--<th class="text-nowrap"><?php //echo lang('htleft_table')?></th>-->
                                        <th class="text-nowrap">Binary</th>
                                        <!--<th><?php //echo lang('htright_table')?></th>-->
                                        <!-- <th>Total</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!--<td>1</td>-->
                                        
                                            <?php
                                            $id_user_net = $this->session->userdata('uid'); 
                                            //echo "<pre>";                              
                                            $ladoNet =  verLadoPatroDirecto($id_user_net);
                                            //print_r($ladoNet);
                                            
                                            //echo "</pre>";
                                            
                                            $ladoNetwork = $ladoNet[0]->chave_binaria;
                                            $id_sponsor = $ladoNet[0]->id_patrocinador;
                                            
                                            if($ladoNetwork==1){
                                                $ladoNetworkText = "Left";
                                            }
                                            
                                            if($ladoNetwork==2){
                                                $ladoNetworkText = "Right";
                                            }
                                            
                                            $nomSponsor = InformacoesUsuario('login', $id_sponsor); 
                                            
                                            //echo "Sponsor: ".$nomSponsor." | Net.: ".$ladoNetworkText;
                                            
                                            ?>
                                        
                                        
                                        <!--<td>
                                            
                                            <?php
                                            if($contBinarios>=2){
                                            //if($condicional == 2){		
                                            ?>
                                            
                                            <?php echo number_format($pontos['hoje']['esquerdo'], 0, ".", "."); ?>
                                            
                                            <?php
                                            }else{
                                                echo "**"; 
                                            }
                                            ?>
                                        </td>-->
                                        <td>
                                            <?php
                                            /*descomentar cuando restes puntos*/
                                            if($contBinarios>=2){		
                                            ?>
                                            <?php echo "Qualified";; ?>
                                            <?php
                                            }else{
                                                echo "No qualified";;
                                            }
                                            ?>
                                        </td>
                                        <!--<td>
                                            <?php //echo number_format($pontos['hoje']['esquerdo'] + $pontos['hoje']['direito'], 0, ".", "."); ?>
                                        </td> -->
                                    </tr>

                                </tbody>
                            </table>
                        </div>                              
                                
                     
                  
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">Total Points</span>
                     </h4>
                     <!--end::Title-->
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">
                         
                        <div class="table-responsive">        

                            <table class="table table-row-dashed text-center align-middle headerCustom">
                                <thead class="">
                                    <tr>
                                        <!--<th>#</th>-->
                                        <th class="text-nowrap"><?php echo lang('htleft_table')?></th>
                                        <th><?php echo lang('htright_table')?></th>
                                        <th><?php echo lang('httotal_table')?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <!--<td>1</td>-->
                                        <td>
                                            <?php echo number_format($pontos['total']['esquerdo'], 0, ".", ".");?>
                                        </td>
                                        <td>
                                            <?php echo number_format($pontos['total']['direito'], 0, ".", ".");?>
                                        </td>
                                        <td>
                                            <?php echo number_format($pontos['total']['esquerdo'] + $pontos['total']['direito'], 0, ".", ".");?>
                                        </td>
                                        
                                        <!--<tr>
                                        <td colspan="3">
                                            
                                            
                                            <?php 

                                                $suma_total_points = $pontos['total']['esquerdo'] + $pontos['total']['direito'];
                                                $suma_points_transfer = $pontos['transferir']['esquerdo'] + $pontos['transferir']['direito'];                                         

                                                if( $suma_total_points > $suma_points_transfer ){
                                                    $acumulado = $suma_total_points - $suma_points_transfer;
                                                }elseif ( $suma_points_transfer > $suma_total_points ) {
                                                    $acumulado = $suma_points_transfer - $suma_total_points;
                                                }
                                            
                                        
                                            //echo '<pre>';

                                            $idUsuarioPlan = $this->session->userdata('uid'); 
                                            //echo "<pre>";                              
                                            $planActivoUser =  verDirectosID($idUsuarioPlan);
                                            //print_r($planActivoUser);
                                            $dosLados = sizeof($planActivoUser);
                                            //echo "</pre>";
                                            
                                            /*descomentar cuando restes puntos*/
                                            //if($contBinarios>=2){ 
                                            if($condicional == 2){	
                                                
                                                //echo lang('title_dialog3')." : " . number_format( $acumulado , 0, ".", ".");  
                                            }else{
                                                //echo "Binary: No qualified"; 
                                            }
                                            

                                                ?>
                                        </td>
                                    </tr>-->
                                        
                                    </tr>

                                </tbody>
                            </table>
                        </div>                              
                                
                     
                  
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->
            
            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">Points to Transfer</span>
                     </h4>
                     <!--end::Title-->
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">

                         
                        <div class="table-responsive">        

                            <table class="table table-row-dashed text-center align-middle headerCustom">
                                <thead class="">
                                    <tr>
                                        <!--<th>#</th>-->
                                        <th class="text-nowrap"><?php echo lang('htleft_table')?></th>
                                        <th><?php echo lang('htright_table')?></th>
                                        <!--<th><?php //echo lang('httotal_table')?></th>-->
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                    <tr>
                                        <!--<td>1</td>-->
                                        
                                        <td>
                                            <?php 
                                            
                                            
                                            $corteIzq = 0;
                                            $corteDer = 0;
                                            if($cortepuntos){
                                                
                                                $corteIzq = $cortepuntos[0]->corteIzquierda;
                                                $corteDer = $cortepuntos[0]->corteDerecha;
                                            }
                                            //echo "<br>";
                                            
                                            
                                            
                                            $ladoNetworkIns;
                                            
                                            if($ladoNetworkIns==1){
                                                //pierna derrame izquierda
                                                if($contBinarios>=2){
                                                    
                                                    echo $tranLeft =	$pontos['transferir']['esquerdo'];
                                                    
                                                }else{
                                                    
                                                    echo " ** ";
                                                    
                                                }
                                                
                                                
                                            }else{
                                                
                                                echo $tranLeft =	$pontos['transferir']['esquerdo'];
                                            }
                                            
                                            
                                            /*echo "<br>";
                                            if($tranLeft>0){
                                                $resultCortesLeft = $tranLeft - corteIzq  ;
                                                echo number_format($resultCortesLeft, 0, ".", ".");
                                            }else{
                                                
                                                echo number_format($pontos['transferir']['esquerdo'], 0, ".", ".");
                                                
                                            }*/
                                            
                                            ?>
                                        </td>
                                        <td>
                                            
                                            <?php 
                                            //echo "<br>".$ladoNetworkIns;
                                            if($ladoNetworkIns==2){
                                                //pierna derrame derecha
                                                
                                                if($contBinarios>=2){
                                                    
                                                    echo $tranRight = number_format($pontos['transferir']['direito']);
                                                    
                                                }else{
                                                    
                                                    echo " ** ";
                                                }
                                                
                                                
                                                
                                            }else{
                                                echo $tranRight = number_format($pontos['transferir']['direito']);
                                            }
                                            
                                            
                                            
                                            /*echo "<br>";
                                            if($tranRight>0){
                                                $resultCortesRight = $tranRight - $corteDer  ;
                                                echo number_format($resultCortesRight, 0, ".", ".");
                                            }else{
                                                
                                                echo number_format($pontos['transferir']['direito']);
                                            }	*/									
                                            ?>
                                        </td>
                                        
                                        
                                        
                                        <!--<td>
                                            <?php //echo number_format($pontos['transferir']['esquerdo'] + $pontos['transferir']['direito'], 0, ".", "."); ?>
                                            
                                            <?php //echo $ladoNetworkText;?>
                                        </td>-->
                                        
                                        
                                        
                                    </tr>
                                    
                                    <!--<tr>
                                        
                                        <!--== edward | binary net im on it and who is my sponsor ==--  
                                        <td colspan="3">
                                            
                                            <?php
                                            $id_user_net = $this->session->userdata('uid'); 
                                            //echo "<pre>";                              
                                            $ladoNet =  verLadoPatroDirecto($id_user_net);
                                            //print_r($ladoNet);
                                            
                                            //echo "</pre>";
                                            
                                            $ladoNetwork = $ladoNet[0]->chave_binaria;
                                            $id_sponsor = $ladoNet[0]->id_patrocinador;
                                            
                                            if($ladoNetwork==1){
                                                $ladoNetworkText = "Left";
                                            }
                                            
                                            if($ladoNetwork==2){
                                                $ladoNetworkText = "Right";
                                            }
                                            
                                            $nomSponsor = InformacoesUsuario('login', $id_sponsor); 
                                            
                                            //echo "Sponsor: ".$nomSponsor." | Net.: ".$ladoNetworkText;
                                            
                                            ?>
                                            
                                        </td>
                                        <!--== edward | binary net im on it and who is my sponsor == 
                                    
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>                              
                                
                     
                  
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">My Rank</span>
                     </h4>
                     <!--end::Title-->
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">
                         
                        <div class="table-responsive">        

                            <table class="table table-row-dashed text-center align-middle headerCustom">
                                <thead class="">
                                    <tr>
                                        <!--<th>#</th>-->
                                        <!--<th class="text-nowrap"><?php //echo lang('htleft_table')?></th>-->
                                        <th class="text-nowrap"><?php echo PlanoCarreira(InformacoesUsuario('plano_carreira'), 'nome'); ?></th>
                                        <!--<th><?php //echo lang('htright_table')?></th>-->
                                        <!-- <th>Total</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>                              
                                
                     
                  
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">My Sponsor</span>
                     </h4>
                     <!--end::Title-->
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">
                         
                        <div class="table-responsive">        

                            <table class="table table-row-dashed text-center align-middle headerCustom">
                                <thead class="">
                                    <tr>
                                        <!--<th>#</th>-->
                                        <!--<th class="text-nowrap"><?php //echo lang('htleft_table')?></th>-->
                                        <th class="text-nowrap"><?php echo consultaPatrocinador(InformacoesUsuario('id')); ?></th>
                                        <!--<th><?php //echo lang('htright_table')?></th>-->
                                        <!-- <th>Total</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                </tbody>
                            </table>
                        </div>                              
                                
                     
                  
                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->



            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10">
               <!--begin::Slider Widget 1-->
               <div  class="card card-flush " >
                  <!--begin::Header-->
                  <!-- <div class="card-header pt-5">
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">Daily Income profit</span>
                     </h4>
                  </div> -->
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-5">

                    <div class="rounded py-3 px-4 my-1 me-6 text-center mb-5" style="border:1px dashed rgb(0 0 0 / 20%);">
                        <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                            <span class="card-label fw-bold text-gray-800 m-0">Daily Income profit</span>
                        </h4>  
                        <h3 class="fs-2 fw-bold counted text-success">
                            <i class="ki-duotone ki-arrow-up-right fs-1 me-1 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> 
                            <?=number_format(ConfiguracoesSistema('porcentagem_dia'),2,',','.')?> %
                        </h3>
                    </div>

                    <?php
                    if($this->DashboardModel->PlanoAtivo() !== false){
                        
                        if($maxGananciaFixed){

                            $maxGanancia = consultaPlanGanancias(InformacoesUsuario('id'));
                            $maxGananciaChart = consultaPlanGanancias(InformacoesUsuario('id'));
                            $maxGananciaChart = round($maxGananciaChart);
            
            
                            /*nueva ganancia 3 paquetes*/
            
                            $maxGananciaThree;	
                            /*nueva ganancia 3 paquetes*/
                        
        
        
                            /*fix chart Edward*/
                            /*new daily bonus chris*/
                            $gananciasChart = 	floatval($referidosGanancia) + floatval($binariosdiaGanancia) + floatval($daily_bonus);
                            if($gananciasChart<0){
                                $gananciasChart = 0;
                            }

                            $porcentaje = ($gananciasChart * 100) / $maxGananciaFixed;
                        if($porcentaje<0){
                            $porcentaje = 0;
                        }
        
                        if($porcentaje>$maxGananciaFixed){
                            $porcentaje = $maxGananciaFixed;
                        }
            
            
                                /*nuevo porcentaje 300% de 3 paquetes*/
                            
                            $porcentajeThree = ($gananciasChart * 100) / $maxGananciaThree;
                            if($porcentajeThree<0){
                                $porcentajeThree = 0;
                            }

                            if($porcentajeThree>$maxGananciaThree){
                                $porcentajeThree = $maxGananciaThree;
                            }
                                
                            $porcentajeThree = round($porcentajeThree);
                            /*nuevo porcentaje 300% de 3 paquetes*/
            
                            ?>

                            <?php 
                            $porcentajeText = ($gananciasChart * 300) / $maxGananciaThree;
                            if($porcentajeText<0){
                                    $porcentajeText = 0;
                            }
    
                            /*if($porcentajeText>$maxGananciaFixed){
                                $porcentajeText = $maxGananciaFixed;
                            }*/

                            $progress =  round($porcentajeThree); 
    
                            $new_progress = empty($progress)?"0": $progress;

                        }

                    }
                    ?>

                    <div class="rounded py-3 px-4 my-1 me-6 text-center" style="border:1px dashed rgb(0 0 0 / 20%);">
                        <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                            <span class="card-label fw-bold text-gray-800 m-0">My Progress</span>
                        </h4>    
                        <h3 class="fs-2 fw-bold counted text-success">
                            <i class="ki-duotone ki-arrow-up-right fs-1 me-1 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> 
                            <?php echo $new_progress?> %
                        </h3>
                        <div class="fw-semibold fs-6 text-success" bis_skin_checked="1">Real Progress</div>
                    </div>

                  </div>
                  <!--end::Body-->
               </div>
               <!--end::Slider Widget 1-->
            </div>
            <!--end::Col-->
                    
            <!--begin::Col-->
            <div class="col-xl-8 mb-xl-10">

                <?php
                if($this->DashboardModel->PlanoAtivo() !== false){
                    
                    if($maxGananciaFixed){
                ?>

                <div  class="card card-flush " >
                  <!--begin::Header-->
                  <div class="card-header pt-5">
                     <!--begin::Title-->
                     <h4 class="card-title d-flex align-items-center m-0 w-100 flex-column">
                        <span class="card-label fw-bold text-gray-800 m-0">Total Profit</span>
                        <span class="text-gray-500 mt-1 fw-bold fs-7">
                            
                        <?php
                        //arreglar	
                        $maxGanancia = consultaPlanGanancias(InformacoesUsuario('id'));
                        $maxGananciaChart = consultaPlanGanancias(InformacoesUsuario('id'));
                        $maxGananciaChart = round($maxGananciaChart);
        
        
                        /*nueva ganancia 3 paquetes*/
        
                        $maxGananciaThree;	
                        /*nueva ganancia 3 paquetes*/
                    
    
    
                        /*fix chart Edward*/
                        /*new daily bonus chris*/
                        $gananciasChart = 	floatval($referidosGanancia) + floatval($binariosdiaGanancia) + floatval($daily_bonus);
                        if($gananciasChart<0){
                            $gananciasChart = 0;
                        }
                        
                        /*fix chart Edward*/
                
                        
                        echo number_format($gananciasChart, 2, ".", ",")  . ' of ' . number_format($maxGananciaThree, 2, ".", ",") . ' USD';

                        ?>

                        </span>
                     </h4>
                     <!--end::Title-->

                        <?php
                            
                        $porcentaje = ($gananciasChart * 100) / $maxGananciaFixed;
                        if($porcentaje<0){
                            $porcentaje = 0;
                        }
        
                        if($porcentaje>$maxGananciaFixed){
                            $porcentaje = $maxGananciaFixed;
                        }
            
            
                                /*nuevo porcentaje 300% de 3 paquetes*/
                            
                            $porcentajeThree = ($gananciasChart * 100) / $maxGananciaThree;
                            if($porcentajeThree<0){
                                $porcentajeThree = 0;
                            }

                            if($porcentajeThree>$maxGananciaThree){
                                $porcentajeThree = $maxGananciaThree;
                            }
                                
                            $porcentajeThree = round($porcentajeThree);
                            /*nuevo porcentaje 300% de 3 paquetes*/
            
                            ?>

                            <?php 
                            $porcentajeText = ($gananciasChart * 300) / $maxGananciaThree;
                            if($porcentajeText<0){
                                    $porcentajeText = 0;
                            }
    
                            /*if($porcentajeText>$maxGananciaFixed){
                                $porcentajeText = $maxGananciaFixed;
                            }*/

                            $progress =  round($porcentajeThree); 
    
                            $new_progress = empty($progress)?"0": $progress;
    
                            
        
                            
                            ?>
                     
                     
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-6 pt-0">


                    <!-- <div class="rounded py-3 px-4 my-1 me-6 text-center" style="border:1px dashed rgb(0 0 0 / 20%);">
                        <h3 class="fs-2 fw-bold counted text-success">
                            <i class="ki-duotone ki-arrow-up-right fs-1 me-1 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> 
                            <?php echo $new_progress?> %
                        </h3>
                        <div class="fw-semibold fs-6 text-success" bis_skin_checked="1">My Progress</div>
                    </div> -->

                    <div class="min-h-auto ms-n3" id="progressHome" data-progress="<?php echo round($porcentajeThree) ?>" style="height: 150px"></div>

                  </div>
                  <!--end::Body-->
               </div>

               <?php
                    }
                }
               ?>

                

            </div>

            <!--end::Col-->

            
            
         </div>
         <!--end::Row-->
         
         
      </div>
      <!--end::Col-->
   </div>
   <!--end::Row-->




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
                  <span class="card-label fw-bold text-gray-900">My Direct Referrals</span>
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
                            <th class="text-nowrap">#</th>
                                <th><?php echo lang('ht_name')?><!--Name--></th>
                                <th><?php echo lang('ht_email')?><!--Email--></th>
                                <th><?php echo lang('ht_plan')?><!--Plan--></th>										
                                <th><?php echo lang('ht_phone')?><!--Phone--></th>
                                <th><?php echo lang('ht_date')?><!--Date--></th>
                            </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <?php
                                if ($directuser !== false) {
                                    
                                    $contRD = 0;
                                    
                                    foreach ($directuser as $direct) {
                                        $contRD++;
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $contRD ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo InformacoesUsuario('login', $direct->id_usuario);?> 
                                            </td>
                                            
                                            <td>
                                                *******<!--<?php echo InformacoesUsuario('email', $direct->id_usuario);?> -->
                                            </td>
                                            
                                            <td>
                                                <?php  
                                                $valorPlan = usersPlanActive($direct->id_usuario); 
                                                if($valorPlan == false){ 
                                                    echo 'Without Plan';
                                                }else{ 
                                                    echo $valorPlan;
                                                }
                                                
                                                ?>
                                            </td>
                                            
                                            <td>
                                            *******	<!--<?php echo InformacoesUsuario('celular', $direct->id_usuario);?> -->
                                            </td>
                                            
                                            <td>
                                                <?php echo InformacoesUsuario('data_cadastro', $direct->id_usuario);?> 
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



   <!--begin::Row-->
   <div class="row g-5 g-xl-10">
      <!--begin::Col-->
      <div class="col-xl-6">
         <!--begin::List widget 21-->
         <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
               <h3 class="card-title align-items-start flex-column">
                  <span class="card-label fw-bold text-gray-900">Share your Link</span>
               </h3>
               
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="textArea" value="<?php echo base_url('register/' . InformacoesUsuario('login')); ?>" />

                    </div>
                    <div class="col-md-4 copyLinkHome">
                        <button onclick="copyToClipBoard()" class="btn btn-primary clipboard" data-clipboard-target="#textArea">
                            <?php echo lang('button1')?>
                        </button>
                    </div>
                </div>
                            

            </div>
            <!--end::Body-->
         </div>
         <!--end::List widget 21-->
      </div>
      <!--end::Col-->
      <!--begin::Col-->
      <div class="col-xl-6">
         <!--begin::List widget 21-->
         <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
               <h3 class="card-title align-items-start flex-column">
                  <span class="card-label fw-bold text-gray-900"><?php echo lang('binary_key')?></span>
               </h3>
               
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                
                <div class="form-check form-check-custom form-check-solid">
                    <label class="radio-inline i-checks m-4">
                        <input class="form-check-input" name="chave_binaria" id="chave_binaria" value="1" type="checkbox" <?php echo (InformacoesUsuario('chave_binaria') == 1) ? 'checked' : ''; ?>>
                        <i></i> <?php echo lang('htleft_table')?>
                    </label>
                    <label class="radio-inline i-checks m-4">
                        <input class="form-check-input" name="chave_binaria" id="chave_binaria" value="2" type="checkbox" <?php echo (InformacoesUsuario('chave_binaria') == 2) ? 'checked' : ''; ?>>
                        <i></i> <?php echo lang('htright_table')?>
                    </label>

                </div>
                            

            </div>
            <!--end::Body-->
         </div>
         <!--end::List widget 21-->
      </div>
      <!--end::Col-->
   </div>
   <!--end::Row-->
</div>
<!--end::Content-->





<style>
    .bg2 {
        background: url('<?php echo base_url(); ?>assets/imgs/chartBack.png');
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    .chartPro {
        position: relative;
        display: inline-block;
        width: 110px;
        height: 110px;
        margin-top: 50px;
        margin-bottom: 50px;
        text-align: center;
    }

    .chartPro canvas {
        position: absolute;
        top: 0;
        left: 0;
    }

    .percent {
        display: inline-block;
        line-height: 110px;
        z-index: 2;
    }

    .percent:after {
        content: '%';
        margin-left: 0.1em;
        font-size: .8em;
    }
</style>

<?php
$url = "https://api.etherscan.io/api?module=stats&action=ethprice&apikey=YJXUP24PXND823YDSI1CKTPZGXD79IQ6NZ";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$salidas = json_decode($output, true);


// echo $salidas['result']['ethusd'];

?>



<script>
    function copyToClipBoard() {

        var content = document.getElementById('textArea');

        content.select();
        document.execCommand('copy');


    }




    // function cantidad(min, max) {
    //     return (Math.random() * (max - min + 1));
    // }



    // function mercado() {
    //     var myArray = ['Coinbase', 'Binance', 'FTX', 'KuCoin', 'Bitfinex', 'Coinbase', 'Binance', ];
    //     var rand = Math.floor(Math.random() * myArray.length);
    //     var rValue = myArray[rand];
		
	// 	let rImage = "";
	// 	/*edward*/
	// 	if(rValue=='Coinbase'){
	// 		rImage = "coinbase.png";
	// 	}
		
	// 	if(rValue=='Binance'){
	// 		rImage = "binance.png";
	// 	}
		
	// 	if(rValue=='FTX'){
	// 		rImage = "ftx.png";
	// 	}
		
	// 	if(rValue=='KuCoin'){
	// 		rImage = "kucoin.png";
	// 	}
		
	// 	if(rValue=='Bitfinex'){
	// 		rImage = "bitfinex.png";
	// 	}
		
	// 	/*edward*/
		
		
		
	// 	rValue = "<span><img src='<?php echo base_url(); ?>assets/imgs/market/"+rImage+"' class='markImg'>"+rValue+"</span>";
    //     // console.log(rValue)
    //     return rValue;
    // }
    // mercado();


    // function book() {
    //     var myArray = ['Buy', 'Sell'];
    //     var rand = Math.floor(Math.random() * myArray.length);
    //     var rValue = myArray[rand];
		
	// 	let flechas ="";
	// 	let color ="";
		
	// 	let td1_c ="";
		
		
	// 	if(rValue=="Buy" ){
	// 		flechas ="<i class='fas fa-arrow-up flechasMarket' style='color:green'></i>";
	// 		color = "txtMarkGreen";
		 
	// 		/*td1_c = document.getElementById("td1");
	// 		td1_c.closest('tr').removeAttribute('class');
	// 		td1_c.closest('tr').classList.add("trGreen");*/
		 
		 
	// 	}
		
	// 	if(rValue=="Sell"){
	// 		flechas ="<i class='fas fa-arrow-down flechasMarket' style='color:red'></i>";
	// 		color = "txtMarkRed";
			
	// 		/*td1_c = document.getElementById("td1");
	// 		td1_c.closest('tr').removeAttribute('class');
	// 		td1_c.closest('tr').classList.add("trRed");*/
			
	// 	}
		
		
		
		
	// 	rValue = "<span class='"+color+"'>"+flechas+rValue+"</span>";
		
    //      //console.log(rValue)
    //     return rValue;
    // }

    // function id() {
    //     let id_trans = Math.floor(Math.random() * (55559878 - 21110000)) + 1;
    //     return id_trans;
    // }
    // id();

    // function crearArray() {
    //     var precio = '<?php echo $salidas['result']['ethusd'] ?>';
    //     n_format = precio * cantidad(0.01, 3.5);
		
	// 	let colorN ="";
		
		
    //     var datos = [

    //         [mercado(), book(), id(), cantidad(0.01, 3.5), '<span class="'+colorN+'">'+n_format.toFixed(2) + ' USD</span>']
    //     ];
    //     var cant2 = cantidad(0.1, 3.0);
    //     var datos2 = [
    //         [mercado(), book(), id(), cant2, precio * cant2]
    //     ];
    //     var cant3 = cantidad(0.1, 3.0);
    //     var datos3 = [
    //         [mercado(), book(), id(), cant3, precio * cant3]
    //     ];
    //     var cant4 = cantidad(0.1, 3.0);
    //     var datos4 = [
    //         [mercado(), book(), id(), cant4, precio * cant4]
    //     ];
    //     var datos5 = [
    //         [mercado(), book(), id(), cant4, precio * cant4]
    //     ];
    //     var cant6 = cantidad(0.1, 3.0);
    //     var datos6 = [
    //         [mercado(), book(), id(), cant6, precio * cant6]
    //     ];
    //     var cant7 = cantidad(0.1, 3.0);
    //     var datos7 = [
    //         [mercado(), book(), id(), cant7, precio * cant7]
    //     ];
    //     var cant8 = cantidad(0.1, 3.0);
    //     var datos8 = [
    //         [mercado(), book(), id(), cant8, precio * cant8]
    //     ];
    //     var cant9 = cantidad(0.1, 3.0);
    //     var datos9 = [
    //         [mercado(), book(), id(), cant9, precio * cant9]
    //     ];
    //     var cant10 = cantidad(0.1, 3.0);
    //     var datos10 = [
    //         [mercado(), book(), id(), cant10, precio * cant10]
    //     ];
    //     var unir = datos.concat(datos2, datos3, datos4, datos5, datos6, datos7, datos8, datos9, datos10);
    //     return unir;

    // }

    // function selectDate(id, in1, in2) {
    //     document.getElementById(id).innerHTML = crearArray()[in1][in2];
    // }

    // function mostrarDate(idD, in1, in2) {
    //     selectDate(idD, in1, in2);
    //     setInterval(function() {
    //         selectDate(idD, in1, in2);
    //     }, 5000);

    // }
    // onload =
    //     mostrarDate('td0', 0, 0),//Title 
	// 	mostrarDate('td1', 0, 1), 
	// 	mostrarDate('td2', 0, 2), 
	// 	mostrarDate('td3', 0, 3), 
	// 	mostrarDate('td4', 0, 4),//usd amount
		
    // 	mostrarDate('td5', 0, 0),//titulo 
	// 	mostrarDate('td6', 0, 1), 
	// 	mostrarDate('td7', 0, 2), 
	// 	mostrarDate('td8', 0, 3), 
	// 	mostrarDate('td9', 0, 4),//usd amount
		
    //     mostrarDate('td10', 0, 0),//Title 
	// 	mostrarDate('td11', 0, 1), 
	// 	mostrarDate('td12', 0, 2), 
	// 	mostrarDate('td13', 0, 3), 
	// 	mostrarDate('td14', 0, 4),
		
    //     mostrarDate('td15', 0, 0),//Title 
	// 	mostrarDate('td16', 0, 1), 
	// 	mostrarDate('td17', 0, 2), 
	// 	mostrarDate('td18', 0, 3), 
	// 	mostrarDate('td19', 0, 4),//usd amount
	
    // 	mostrarDate('td20', 0, 0),//Title 
	// 	mostrarDate('td21', 0, 1), 
	// 	mostrarDate('td22', 0, 2), 
	// 	mostrarDate('td23', 0, 3), 
	// 	mostrarDate('td24', 0, 4);//usd amount
    // mostrarDate('td5', 0, 0), mostrarDate('td6', 0, 1), mostrarDate('td7', 0, 2), mostrarDate('td8', 0, 3), mostrarDate('td9', 0, 4)
</script>

<script>
/*	
var xValues = ["Ganancia", "Total"];
var yValues = [100, 300];
var barColors = [
  "#b91d47",
  "#00aba9",

];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    },


    aspectRatio: 2,
    borderColor: 'black',
        width: 2,

  }
});*/
</script> 