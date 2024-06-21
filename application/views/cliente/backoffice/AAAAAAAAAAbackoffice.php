<div id="content" class="ui-content ui-content-aside-overlay">
    <div class="ui-content-body">

        <div class="ui-container">

            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Backoffice
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li><a href="javascript:void(0);">Backoffice</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            
            <div class="row">
                <div class="col-md-12">
                    <p>Olá <?php echo InformacoesUsuario('nome');?>, bem-vindo ao backoffice da nossa empresa. Atualize suas informações pessoais e deixe sempre seu cadastro em dia para não ocorrer problemas futuros. Nossa equipe sempre irá trabalhar para você ter o melhor sistema de MMN.</p>
                    
                </div>
            </div>
            
            <!--states start-->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-danger">
                        <div class="pull-right state-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt">R$ <?php echo number_format(InformacoesUsuario('saldo_rendimentos'), 2, ",", ".");?></h1>
                            <strong class="text-uppercase">Saldo de Rendimentos</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-info">
                        <div class="pull-right state-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt">R$ <?php echo number_format(InformacoesUsuario('saldo_indicacoes'), 2, ",", ".");?></h1>
                            <strong class="text-uppercase">Saldo de Indicação</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-warning">
                        <div class="pull-right state-icon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt"><?php echo PlanoCarreira(InformacoesUsuario('plano_carreira'), 'nome');?></h1>
                            <strong class="text-uppercase">Plano de Carreira</strong>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-primary">
                        <div class="pull-right state-icon">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt"><?php echo (InformacoesUsuario('binario') == 1) ? 'Ativo' : 'Inativo';?></h1>
                            <strong class="text-uppercase">Seu Binário</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-success">
                        <div class="pull-right state-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt"><?php echo $rede;?></h1>
                            <strong class="text-uppercase">Minha Rede</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="panel short-states bg-primary" style="background:#2E3E4E;">
                        <div class="pull-right state-icon">
                            <i class="fa fa-bitcoin"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt">R$ <?php echo $this->bitcoin->Price();?></h1>
                            <strong class="text-uppercase">Valor Bitcoin Hoje</strong>
                        </div>
                    </div>
                </div>
                <?php
                if($this->DashboardModel->PlanoAtivo() !== false){
                ?>
                <div class="col-md-12 col-sm-12">
                    <div class="panel short-states bg-danger" style="background:#E0AE94">
                        <div class="pull-right state-icon">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="panel-body">
                            <h1 class="light-txt" id="fim_plano"></h1>
                            <strong class="text-uppercase">Tempo para expirar seu plano</strong>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <!--states end-->
            
            <div class="row">
                <div class=" col-lg-6 col-md-6 col-xs-12 col-sm-12 text-center">

                    <h4 class="text-uppercase">Link de Indicação</h4>
                    <table class="table">
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" id="linkIndicacao" value="<?php echo base_url('cadastrar/'.InformacoesUsuario('login'));?>" style="margin-bottom:0" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <button class="btn btn-danger clipboard" data-clipboard-target="#linkIndicacao">
                                    Copiar Link
                                </button>

                                <div class="fb-share-button" data-href="<?php echo base_url('cadastrar/'.InformacoesUsuario('login'));?>" data-layout="box_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('cadastrar/'.InformacoesUsuario('login'));?>&amp;src=sdkpreparse">Compartilhar</a></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>