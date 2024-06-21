<!--main content start-->
<section id="saque" class="d-flex justify-content-center align-items-center mt-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold">Withdrawal</h1>
                </div>
                <div class="content py-4 px-4 position-relative">
                    <div class="detalle position-relative">
                            <!--<p class="alerta p-2 text-white text-center text-small">
            <strong> Withdrawal period</strong> 24 - 48 hours.<br>
            <i class='fa-solid fa-arrow-right' style='color: white'> </i>  The term will vary depending on the market.
            <br>
            <strong>Days that withdrawal can be requsted</strong>
<br>
            <i class='fa-solid fa-arrow-right' style='color: white'></i>  Monday to Friday
            <br><br>
            <strong>WITHDRAWAL FEES</strong>
            <br>
            <i class="fa-solid fa-circle-check"></i> After 24 hours <strong> 10%</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <i class="fa-solid fa-circle-check"></i> 15 Calendar days  <strong> 5%</strong>
            <br>
            
                    <i class="fa-solid fa-circle-check"></i> After 24 hours <strong> 10%</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <i class="fa-solid fa-circle-check"></i> 15 Calendar days  <strong> 5%</strong>
<br><br>
            <strong> Maximum limit of total daily earnings:<br>
            <small> In the choosen plan. All bonuses will be added, except prizes. <br>
                    <strong> Example: Binary, referral bonus, daily earnings, residaul bonus.</strong></small>
                    <br><BR>
                    <STRONG>EARNING DAYS</STRONG> <BR>
                    <i class="fa-solid fa-circle-check"></i> MONDAY - <strong>DUBAI</strong> - <i class="fa-solid fa-circle-check"></i> FRIDAY
                   
</p>-->

                        <?php
                        $saldo_rendimentos = InformacoesUsuario('saldo_rendimentos');
                        $vminre = ConfiguracoesSistema('valor_minimo_saque_rendimentos');
                        $valor_referral = InformacoesUsuario('saldo_indicacoes');
                        $vmin = ConfiguracoesSistema('valor_minimo_saque_indicacoes');
                        $valor_binary = InformacoesUsuario('binarios_dia');

                        if (isset($_GET['success'])) {
                            if ($_GET['success'] == 1) {
                                echo '<div class="alert alert-success" role="alert">
							<strong>Felicidades!!!!. Retiro Confirmado</strong>
						</div>';
                            }
                            if ($_GET['success'] == 2) {
                                echo '<div class="alert alert-danger" role="alert">
							<strong>Atención!!!!. Retiro Cancelado por saldo insuficiente</strong>
						</div>';
                            }
                            if ($_GET['success'] == 3) {
                                echo '<div class="alert alert-danger" role="alert">
							<strong>Atención!!!!. El Retiro no existe!!!</strong>
						</div>';
                            }
                            if ($_GET['success'] == 4) {
                                echo '<div class="alert alert-danger" role="alert">
							<strong>Atención!!!!. Retiro Entregado!!!</strong>
						</div>';
                            }
                        }

                        if (isset($_GET['data']) and $_GET['data'] != "") {

                            $id_trans = $_GET['data'];
                            $query = $this->db->get_where('saques_transaction',['st_transaction' => $id_trans]);
                            $info = $query->row();
                            if(!is_object($info)){
                                redirect(base_url('withdraw?success=3'));
                            }
                            if($info->st_active == 0){
                                redirect(base_url('withdraw?success=4'));
                            }
                            $data = base64_decode($info->st_data);
                            $dataFinal = explode("|", $data);
                            $id_usuario = $dataFinal[0];
                            $id_conta = $dataFinal[1];
                            $tipo_saque = $dataFinal[2];

                            $local_recebimento = $dataFinal[3];
                            $valor = $dataFinal[4];
                            $valor_solicitado = $dataFinal[5];

                            if ($tipo_saque == 1) {
                                if ($valor_solicitado > $saldo_rendimentos) {
                                    redirect(base_url('withdraw?success=2'));
                                }
                            } elseif ($tipo_saque == 2) {
                                if ($valor_solicitado > $valor_referral) {
                                    redirect(base_url('withdraw?success=2'));
                                }
                            } else {
                                if ($valor_solicitado > $valor_binary) {
                                    redirect(base_url('withdraw?success=2'));
                                }
                            }
                            $local_recebimento = $dataFinal[6];
                            $time_pay = $dataFinal[7];
                            $data_pedido = date('Y-m-d H:i:s');

                            $datosIns = array(
                                'id_usuario' => $id_usuario,
                                'id_conta' => $id_conta,
                                'tipo_saque' => $tipo_saque,
                                'local_recebimento' => $local_recebimento,
                                'valor' => $valor,
                                'valor_solicitado' => $valor_solicitado,
                                'time_pay' => $time_pay,
                                'status' => 0,
                                'data_pedido' => $data_pedido
                            );
                            $this->db->insert('saques', $datosIns);

                            /* user */

                            //$userD = $_GET['user'];
                            $userD = base64_decode($info->st_user_data);
                            $userDfinal = explode("|", $userD);

                            $novo_saldo = $userDfinal[0];
                            $retirar_de = $userDfinal[1];

                            $valor_desconto = $userDfinal[2];
                            $taxa_saque = $userDfinal[3];

                            $this->db->where('id', $id_usuario);
                            $this->db->update('usuarios', array($retirar_de => $novo_saldo));

                            GravaExtrato($id_usuario, $valor_desconto, 'Petición de retiro', 2);
                            GravaExtrato($id_usuario, $taxa_saque, 'Tarifa de retiro', 2);
                            //actualizar seque_trans
                            $this->db->where('st_transaction', $id_trans);
                            $this->db->update('saques_transaction', [
                                'st_active' => 0,
                                'st_date_upd' => date('Y-m-d H:i:s')
                            ]);
                            /* user */

                            $mensRetiro = 'Felicidades!!! <b>' . InformacoesUsuario('nome') . '</b>, Su petición de retiro fue confirmada y se le desconto <b> ' . number_format($valor_desconto, 2, ",", ".") . ' USD</b> de su cuenta. Muy Pronto estara su Wallet';

                            $this->sendmail->EnviarEmail(InformacoesUsuario('email'), 'Petición de Retiro Confirmado', $mensRetiro);
                            redirect(base_url('withdraw?success=1'));
                            ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Felicidades!!!!. Retiro Confirmado</strong>
                            </div>
                            <?php
                        }
                        ?>


                        <p class="alerta p-2 text-white text-center text-small">

                            <strong><i class="fas fa-wallet"></i> Withdrawal</strong>

                        </p>


                        <div class="opciones pt-3 d-md-flex justify-content-evenly align-items-md-center">

                            <div class="row">

                                <div class="col-md-12 m-2">
                                    <h6 class="m-md-0 fw-bolder">How much do you want to withdraw?</h6>
                                </div>


                                <?php
                                $tiempoRertiro = verPlanActualUsuario(InformacoesUsuario('id'));

                                $tiempoRertiro[0]->nome;
                                $fecha30_retiro = $tiempoRertiro[0]->data_pagamento;

                                $fecha_actual = date('Y-m-d');
                                $fechaRetiroDailyBonus = date("Y-m-d", strtotime($fecha30_retiro . "+30 days"));
                                ?>

                                <?php
                                /* restringir los dias de los retiros */
                                $hoje = date('w');
                                $hora = date('H:i:s');

                                $retiroDisponible = 0;

                                $datas = $this->db->get('configuracao_pagamento_saque');

                                if ($datas->num_rows() > 0) {

                                    foreach ($datas->result() as $data) {

                                        if ($data->dia_pagamento == $hoje) {

                                            if ($hora >= $data->horario_inicio && $hora <= $data->horario_termino) {

                                                $retiroDisponible = 1;
                                            }
                                        }
                                    }
                                }

                                /* restringir los dias de los retiros */
                                ?>

                                <?php
                                if ($retiroDisponible === 1) {
                                    ?>

                                    <div class="col-md-4 form-check">

                                        <?php if ($saldo_rendimentos >= $vminre): ?>
                                            <?php
                                            if ($fecha_actual >= $fechaRetiroDailyBonus) {
                                                ?>
                                                <input name="tipo_saque" id="tipo_saque" value="1" type="radio">
                                                <?php
                                            }
                                            ?>
                                        <?php endif; ?>
                                        <i></i> Daily Bonus <b>( <?php echo number_format($saldo_rendimentos, 2, ",", "."); ?> USD) </b>
                                        <?php
                                        if ($fecha_actual < $fechaRetiroDailyBonus) {
                                            ?>
                                            <br><small>You can withdraw at <?php echo $fechaRetiroDailyBonus; ?></small>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-md-4 form-check">
                                        <?php if ($valor_referral >= $vmin): ?>
                                            <input name="tipo_saque" id="tipo_saque" value="2" type="radio">
                                        <?php endif; ?>
                                        <i></i>Referral Bonus <b>( <?php echo number_format($valor_referral, 2, ",", "."); ?> USD) </b>
                                    </div>

                                    <div class="col-md-4 form-check">
                                        <?php if ($valor_binary >= $vmin): ?>
                                            <input name="tipo_saque" id="tipo_saque" value="3" type="radio">
                                        <?php endif; ?>
                                        <i></i>Binary <b>( <?php echo number_format($valor_binary, 2, ",", "."); ?> USD) </b>
                                    </div>


                                    <?php
                                } else {
                                    ?>

                                    <div class="lugar_recebimento col-md-12">

                                        <div class="col-md-12 mt-3 w-100 form-check">

                                            <span>
                                                Horario no disponible para retiros
                                            </span>

                                        </div>


                                    </div>

                                    <?php
                                }
                                ?>


                                <div class="lugar_recebimento col-md-12" style="display:none">
                                    <div class="col-md-12 mt-3 w-100 form-check">
                                        <span>
                                            Where do you want to receive?
                                        </span>
                                    </div>
                                    <div class="col-md-12 ">
                                        <input name="local_recebimento" id="local_recebimento" value="2" type="radio">
                                        <i></i> My Wallet USDT BEP20
                                    </div>
                                </div>



                                <div class="recebimento_conta col-md-6" style="display:none">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#new_bank" style="margin-right:20px;"><i class="fa fa-bank"></i> Register</button>
                                    </div>
                                </div>

                                <div class="recebimento_carteira col-md-6 mt-3" style="display:none; width: 100%;">
                                    <table class="table table-borderd w-100">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Wallet</th>
                                            </tr>
                                        </thead>
                                        <tbody id="append_carteira">
                                            <tr data-id="<?php echo InformacoesUsuario('cpf'); ?>">
                                                <td><input type="radio" name="carteira_bitcoin" id="carteira_bitcoin" value="<?php echo InformacoesUsuario('cpf'); ?>" /></td>
                                                <td class="text-break"><?php echo InformacoesUsuario('cpf'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="bloco_confirmacao" style="display:none;">
                            <div class="row mt-5 ">
                                <div class="col-md-12 mb-3">
                                    <span>Amount to Withdraw</span><br>
                                </div>
                                <div class="col-sm-6 mb-3  mt-3">
                                    <label>Amount</label>
                                    <input type="text" id="valor_saque" class="form-control u-rounded ">
                                </div>
                                <div class="col-sm-6 mb-3  mt-3">
                                    <label>Withdrawal Date</label>
                                    <select id="timeSaque" name="timeSaque" class="timeSaque form-control u-rounded ">
                                        <option value="5">24 hours (fee 6%)</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3 mt-3">
                                    <input type="hidden" name="timeText" id="timeText" value="24 hours">
                                    <button type="button" id="solicitar_saque" class="btn btn-primario w-100"><i class="fa fa-check"></i> Request Withdraw</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>