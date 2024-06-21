<!--main content start-->
<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-3 my-auto">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold w-50">Pending</h1>
                </div>
                <div id="msj" class="alert alert-bg-danger"></div>
                <div class="content py-4 px-4 position-relative">
                    <?php if (isset($message)) echo $message; ?><br><br>
                    <div class="detalle w-100 position-relative ">
                        <table id="tblDateEx" width='100%' class="w-100">
                            <thead class="">
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                    Registration Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    if ($pendentes !== false) {
                                        foreach ($pendentes as $pendente) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $pendente->nome; ?>
                                                </td>
                                                <td>
                                                    <?php echo $pendente->email; ?>
                                                </td>
                                                <td>
                                                    <?php echo $pendente->celular; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y H:i:s', strtotime($pendente->data_cadastro)); ?>
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