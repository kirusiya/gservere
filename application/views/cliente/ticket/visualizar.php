<!--main content start-->


















<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-3 my-auto">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xl-10 p-3">
        <div class="text-center position-relative d-flex align-items-center justify-content-center">
          <img src="<?php echo  base_url() ?>assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
          <h1 class="display-5 text-white fw-bold w-50">Tickets</h1>
        </div>
        <div class="content py-4 px-4 position-relative">

          <div class="detalle w-100 position-relative ">

            <div class="row">



              <div class="col-md-12">
                <form action="" method="post" class="form-horizontal form-variance">
                  <div class="col-md-12">
                    <h4>
                      Subject: <?php echo $ticket->assunto; ?>
                    </h4>
                  </div>
                  <div class="col-md-12 m-3">
                    <?php
                    if ($this->session->userdata('message_ticket')) {
                      echo $this->session->userdata('message_ticket');
                      $this->session->unset_userdata('message_ticket');
                    }

                    if (isset($message)) {
                      echo $message;
                    }
                    ?>

                  </div>

                  <div class="col-md-12 mt-3">


                    <table id="tblDateEx" width='100%' class="w-100">
                      <thead>
                        <tr>
                          <td></td>
                          <td>Message</td>
                          <td>Date</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($mensagens !== false) {
                          foreach ($mensagens as $mensagem) {
                        ?>
                            <tr>
                              <td style="color: red;"><?php echo ($mensagem->respondido_por == 1) ? 'You: ' : 'Support: '; ?></td>
                              <td style="padding-left: 30px;"> <?php echo $mensagem->mensagem; ?></td>
                              <td>[<?php echo date('d/m/Y H:i:s', strtotime($mensagem->data)); ?>] </td>

                            </tr>

                        <?php
                          }
                        }
                        ?>
                      </tbody>

                    </table>









                  </div>
                  <div class="row pt-5 mt-5">
                  <?php
                    if ($ticket->status != 3) {
                    ?>


                      <div class="col-md-8">
                        <input type="text" class="form-control" name="resposta" placeholder="Type your answer here">
                      </div>
                      <div class="col-md-4">
                        <input type="submit" class="btn btn-primario w-100 text-uppercase" name="submit" value="Answer">

                      </div>

                    <?php
                    } else {
                      echo '<div class="alert alert-danger text-center">Cannot interact with this ticket as it has been closed.</div>';
                    }
                    ?>

                  </div>




                </form>


              </div>
            </div>











          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!--main content end-->