<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <!--begin::Toolbar wrapper-->
   <div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2" id="kt_toolbar">
      <!--begin::Page title-->
      <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
         <!--begin::Title-->
         <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Section: Users Packages</h1>
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
            <li class="breadcrumb-item text-muted">Users Packages</li>
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
                  <span class="card-label fw-bold text-gray-900">My Packages</span>
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
							<th>Invoice</th>
							<th>Plan Name</th>
							<th>Plan Cost</th>
							
							<th>300% Max</th>										
							<th>Date Buyed</th>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            
							<?php
							$idUsuario = $this->session->userdata('uid'); 
							//echo $idUsuario;                              
							$planActivoUser =  usersPlanActive($idUsuario);
							if($planActivoUser == false){
								
							?>
								<tr>
									
									<td>#</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									
									<td>No Data</td>
									<td>No Data</td>
									
								</tr>	
							<?php
								
								
							}else{
								
								/*mostramos los planes que tiene*/
		
		
								$idUserPlanes = $this->session->userdata('uid'); 
								$plansThree =  usersLastThree($idUserPlanes);


								if($plansThree){
									
									$contP = 0;

									foreach($plansThree as $plansAll){
										
										$contP++;
										
										?>
											<tr>

												<td><?php echo $contP;?></td>
												<td>#<?php echo $plansAll->id;?></td>
												<td><?php echo $plansAll->nome;?></td>
												<td><?php echo $plansAll->valor;?> USD</td>

												<td><?php echo $plansAll->ganhos_maximo;?> USD</td>
												<td><?php echo $plansAll->data_pagamento;?></td>

											</tr>	 
										<?php	
										
									}
									
									
								}else{
									
									?>
										<tr>

											<td>#</td>
											<td>No Data</td>
											<td>No Data</td>

											<td>No Data</td>
											<td>No Data</td>

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
