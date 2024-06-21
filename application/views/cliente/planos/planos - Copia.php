<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">

        <div class="ui-container">

            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Planos
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Home</li>
                        <li><a href="<?php echo base_url('planos');?>" class="active">Planos</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
                
                <?php 
                if($this->session->userdata('message_planos')){

                    echo $this->session->userdata('message_planos');
                    $this->session->unset_userdata('message_planos');
                }
                ?>
                
                <?php
                if($planos !== false){
                ?>
                <div class="price-list padd-less">
                    <?php
                    foreach($planos as $plano){
                    ?>
                    <div class="col-md-4">
                        <div class="panel text-center price-table <?php echo ($plano->recomendado == 1) ? 'price-featured bg-primary' : '';?>">
                            <?php echo ($plano->recomendado == 1) ? '<div class="featured">Destaque</div>' : '';?>
                            <h3><?php echo $plano->nome;?></h3>
                            <div class="price-value">
                                <small>u$</small>
                                <span><?php echo number_format($plano->valor, 2, ",", ".");?></span>
                            </div>
                            <ul class="list-unstyled">
                                <li>- Binário <?php echo (is_null($plano->binario) || $plano->binario == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = '.$plano->binario.'%';?></li>
                                <li>- Plano de carreira <?php echo (is_null($plano->plano_carreira) || $plano->plano_carreira == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = '.$plano->plano_carreira.' pontos';?></li>
                                <li>- Rede de afiliados <?php echo ($plano->rede_afiliados == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';?></li>
                                <li>- Teto binário <?php echo (is_null($plano->teto_binario) || $plano->teto_binario == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = R$ '.number_format($plano->teto_binario, 2, ",", ".").'/dia';?> </li>
                                <li>- Ganhos diários <?php echo (is_null($plano->ganhos_diarios) || $plano->ganhos_diarios == 0) ? '<i class="fa fa-times text-danger"></i>' : ' = R$ '.number_format($plano->ganhos_diarios, 2, ",", ".");?> </li>
                            </ul>
                            <?php
                            $downgrade = $this->PlanosModel->DesabilitaDowngrade($plano->valor);

                            if($downgrade){
                                $disabled = 'disabled';
                                $href = 'javascript:void(0);';
                            }else{
                                $disabled = '';
                                $href = base_url('planos/comprar/'.$plano->id);
                            }
                            ?>
                            <a href="javascript:void(0);" <?php echo $disabled;?> class="btn <?php echo ($plano->recomendado == 1) ? 'btn-success' : 'btn-info';?> <?php echo $disabled;?>" onclick="window.location.href='<?php echo $href;?>'">Comprar</a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }else{
                    echo '<div class="alert alert-danger text-center">Não temos nenhum plano no momento. Por favor, volte mais tarde.</div>';
                }
                ?>
            </div>

        </div>

    </div>
</div>
<!--main content end-->