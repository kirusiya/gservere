<!--main content start-->
<section id="saque" class="d-flex justify-content-center align-items-center pt-5 mt-3">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="text-center position-relative d-flex align-items-center justify-content-center">
                <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                <h1 class="display-5 text-white fw-bold w-50">Binary Points</h1>
            </div>
            <div class="col-md-6 col-xl-4 p-3">
                <h5 class="fw-normal">Today's Points</h5>
                <div class="content py-4 px-4 position-relative">
                    <div class="detalle w-100 position-relative table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Left</th>
                                    <th>Right</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td>1</td>
                                    <td>
                                        <?php echo number_format($pontos['hoje']['esquerdo'], 0, ".", "."); ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($pontos['hoje']['direito'], 0, ".", "."); ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($pontos['hoje']['esquerdo'] + $pontos['hoje']['direito'], 0, ".", "."); ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-xl-4 p-3">
                <h5 class="fw-normal">Total Points</h5>
                <div class="content py-4 px-4 position-relative">

                    <div class="detalle w-100 position-relative table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Left</th>
                                    <th>Right</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td>1</td>
                                    <td>
                                        <?php echo number_format($pontos['transferir']['esquerdo'], 0, ".", "."); ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($pontos['transferir']['direito'], 0, ".", "."); ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($pontos['transferir']['esquerdo'] + $pontos['transferir']['direito'], 0, ".", "."); ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <p class="alerta p-2 text-white text-center w-75 text-small mt-3 mb-5">
                Every day at midnight, the system takes the number of points from the difference between the
                computers on your binary network. Every time there is a new difference, a binary bonus will be released according to
                the percentage of your plan, based on the smallest team.
            </p>

        </div>
    </div>
</section>
<!--main content end-->