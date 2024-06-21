<!--main content start-->




<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-5 my-auto">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo  base_url() ?>assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold w-50">Support</h1>
                </div>
                <div class="content py-4 px-4 position-relative">

                    <div class="detalle w-100 position-relative ">
                        <!-- <button class="btn btn-primario btn-sm my-3">Crear
                                Ticket</button> -->
                        <a href="<?php echo base_url('ticket/abrir'); ?>" class="btn btn-primario btn-sm my-3">Create
                            Ticket</a>
                            <table id="tblDateEx" width='100%' class="w-100">
                            <thead class="">
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                    Subject
                                    </th>
                                    <th>
                                    Last update
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($tickets !== false) {
                                    foreach ($tickets as $ticket) {
                                ?>
                                        <tr>
                                            <td>
                                                #<?php echo $ticket->id; ?>
                                            <td>
                                                <?php echo $ticket->assunto; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d/m/Y H:i:s', strtotime($ticket->ultima_atualizacao)); ?>
                                            </td>
                                            <td>
                                                <?php
                                                switch ($ticket->status) {

                                                    case 1:
                                                        echo '<span class="text-warning">Waiting for support response</span>';
                                                        break;

                                                    case 2:
                                                        echo '<span class="text-success">Answered by support</span>';
                                                        break;

                                                    case 3:
                                                        echo '<span class="text-danger">Closed</span>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primario" href="<?php echo base_url('ticket/visualizar/' . $ticket->id); ?>">To view</a>
                                                <?php
                                                if ($ticket->status != 3) {
                                                    echo ' | <a class="btn btn-sm btn-primario" href="' . base_url('ticket/fechar/' . $ticket->id) . '">Closed Ticket</a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--main content end-->