<!--main content start-->
<div id="content" class="ui-content">
  <div class="ui-content-body">
      <div class="ui-container">
          <!--page title and breadcrumb start -->
          <div class="row">
              <div class="col-md-8">
                  <h1 class="page-title"> Visualizar Ticket
                      <small>visualizar ticket</small>
                  </h1>
              </div>
              <div class="col-md-4">
                  <ul class="breadcrumb pull-right">
                      <li>Inicio</li>
                      <li>Tickets</li>
                      <li><a href="<?php echo base_url('ticket/visualizar/'.$tickets[0]->id_ticket);?>" class="active">Visualizar Ticket</a></li>
                  </ul>
              </div>
          </div>
          <!--page title and breadcrumb end -->
    
          <!-- page start-->
          <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">

                      <form action="" method="post" class="form-horizontal form-variance">

                        <div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                        Asunto: <?php echo $tickets[0]->assunto;?>
                                        <?php
                                        if($tickets[0]->status != 3){
                                        ?>
                                        <a href="<?php echo base_url('admin/tickets/fechar/'.$tickets[0]->id_ticket);?>" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Cerrar ticket</a>
                                        <?php
                                        }
                                        ?>
                                    </header>
                                    <div class="panel-body">
                                        <?php

                                        if(isset($message)){
                                          echo $message;
                                        }
                                        ?>
                                        <ul class="chats cool-chat">

                                            <?php
                                            if($tickets !== false){
                                              foreach($tickets as $ticket){
                                            ?>
                                            <li class="<?php echo ($ticket->respondido_por == 1) ? 'out' : 'in'; ?>">
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a class="name" href="javascript:void(0);"><?php echo ($ticket->respondido_por == 1) ? InformacoesUsuario('nome', $ticket->id_usuario) : 'Suporte'; ?></a>
                                                    <span class="datetime"><?php echo date('d/m/Y H:i:s', strtotime($ticket->data));?></span>
                                                    <span class="body">
                                                        <?php echo $ticket->mensagem;?>
                                                    </span>
                                                </div>
                                            </li>
                                            <?php
                                              }
                                            }
                                            ?>

                                        </ul>

                                    </div>
                                    <div class="panel-footer">
                                        <?php
                                        if($tickets[0]->status != 3){
                                        ?>
                                        <div class="input-group srch-lg mbot-0">
                                            <input type="text" class="form-control" name="resposta" placeholder="Escriba su respuesta aquí">
                                            <span class="input-group-btn">
                                                <input type="submit" class="btn btn-primary text-uppercase" name="submit" value="Responder">
                                            </span>
                                        </div>
                                        <?php
                                        }else{
                                          echo '<div class="alert alert-danger text-center">No se puede interactuar con este ticket porque se ha cerrado.</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                  
                      </form>

                      </div>
                  </section>
              </div>
          </div>

      </div>

  </div>
</div>
<!--main content end-->