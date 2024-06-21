$(document).ready(function(){

    $(document).on('change', '#tipo_saque', function(){

        $('.lugar_recebimento').css('display', 'block');
        $('#local_recebimento').prop('checked', false);

        $('#conta_bancaria').prop('checked', false);
        $('#carteira_bitcoin').prop('checked', false);

        $('.recebimento_conta').css('display', 'none');
        $('.recebimento_carteira').css('display', 'none');

        $('#bloco_confirmacao').css('display', 'none');

        $('#valor_saque').val('');
    });

    $(document).on('change', '#local_recebimento', function(){

        let local = $('#local_recebimento:checked').val();

        $('#bloco_confirmacao').css('display', 'none');
        $('#conta_bancaria').prop('checked', false);
        $('#carteira_bitcoin').prop('checked', false);
        $('#valor_saque').val('');

        if(local == 1){
            $('.recebimento_conta').css('display', 'block');
            $('.recebimento_carteira').css('display', 'none');
        }else{
            $('.recebimento_conta').css('display', 'none');
            $('.recebimento_carteira').css('display', 'block');
        }
    });

    $(document).on('change', '#conta_bancaria', function(){

        $('#bloco_confirmacao').css('display', 'block');
        $('#valor_saque').val('');

        $("#valor_saque").maskMoney({allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
    });

    $(document).on('change', '#carteira_bitcoin', function(){

        $('#bloco_confirmacao').css('display', 'block');
        $('#valor_saque').val('');

        $("#valor_saque").maskMoney({allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
    });

    $(document).on('keyup', '#agencia_numero', function(){

        if($(this).val() != ''){
            $('#errorAgencyNumber').html('');
            $('#agencia_numero').css('border', '');
        }else{
            $('#errorAgencyNumber').html('Enter your agency number');
            $('#agencia_numero').css('border', '1px solid #ff6c60');
        }
    });

    $(document).on('keyup', '#conta_numero', function(){

        if($(this).val() != ''){
            $('#errorAccountNumber').html('');
            $('#conta_numero').css('border', '');
        }else{
            $('#errorAccountNumber').html('Enter your account number');
            $('#conta_numero').css('border', '1px solid #ff6c60');
        }
    });

    $(document).on('keyup', '#conta_digito', function(){

        if($(this).val() != ''){
            $('#errorAccountDigit').html('');
            $('#conta_digito').css('border', '');
        }else{
            $('#errorAccountDigit').html('Enter your account number');
            $('#conta_digito').css('border', '1px solid #ff6c60');
        }
    });

    $(document).on('keyup', '#titular', function(){

        if($(this).val() != ''){
            $('#errorTitular').html('');
            $('#titular').css('border', '');
        }else{
            $('#errorTitular').html('Enter the name of the account holder');
            $('#titular').css('border', '1px solid #ff6c60');
        }
    });

    $(document).on('keyup', '#documento', function(){

        if($(this).val() != ''){
            $('#errorDocument').html('');
            $('#documento').css('border', '');
        }else{
            $('#errorDocument').html('Inform the CPF/CNPJ of the account holder');
            $('#documento').css('border', '1px solid #ff6c60');
        }
    });

    $(document).on('click', '#cadastrar_conta_bancaria', function(){

        let errors = 0;
        let codigo_banco = $('#banco option:selected').val();
        let banco_completo = $('#banco option:selected').text();
        let agencia_numero = $('#agencia_numero').val();
        let agencia_digito = $('#agencia_digito').val();
        let conta_numero = $('#conta_numero').val();
        let conta_digito = $('#conta_digito').val();
        let tipo_conta = $('#tipo_conta').val();
        let operacao = $('#operacao').val();
        let titular = $('#titular').val();
        let documento = $('#documento').val();
        let TipoConta = (tipo_conta == 1) ? 'Current' : 'Savings';

        if(agencia_numero == ''){
            $('#errorAgencyNumber').html('Enter your agency number');
            $('#agencia_numero').css('border', '1px solid #ff6c60');
            errors++;
        }

        if(conta_numero == ''){
            $('#errorAccountNumber').html('Enter your account number');
            $('#conta_numero').css('border', '1px solid #ff6c60');
            errors++;
        }

        if(conta_digito == ''){
            $('#errorAccountDigit').html('Enter your account number');
            $('#conta_digito').css('border', '1px solid #ff6c60');
            errors++;
        }

        if(titular == ''){
            $('#errorTitular').html('Enter the name of the account holder');
            $('#titular').css('border', '1px solid #ff6c60');
            errors++;
        }

        if(documento == ''){
            $('#errorDocument').html('Inform the CPF/CNPJ of the account holder');
            $('#documento').css('border', '1px solid #ff6c60');
            errors++;
        }

        if(errors > 0){
            return false;
        }

        $.ajax({
            url: baseURL+'requests/add_bank_account',
            data: {codigo_banco:codigo_banco, agencia_numero:agencia_numero, agencia_digito:agencia_digito, conta_numero:conta_numero, conta_digito:conta_digito, tipo_conta:tipo_conta, operacao:operacao, titular:titular, documento:documento},
            type: 'POST',
            dataType: 'json',

            beforeSend: function(){

                $('#cadastrar_conta_bancaria').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
            },

            success: function(callback){

                let html = '';

                if(callback.status == 1){

                    $('.close').click();

                    html += '<tr data-id="'+callback.id+'">';
                    html += '<td><input type="radio" name="conta_bancaria" id="conta_bancaria" value="'+callback.id+'" /></td>';
                    html += '<td>';
                    html += banco_completo+'<br /><strong>'+TipoConta+'</strong>';
                    html += '</td>';
                    html += '<td>'+agencia_numero+'</td>';
                    html += '<td>'+conta_numero+'-'+conta_digito+'</td>';
                    html += '<td>';
                    html += '<button type="button" class="btn btn-danger" id="delete_bank" data-id="'+callback.id+'"><i class="fa fa-times"></i></button>';
                    html += '</td>';

                    $('#append_bank').append(html);

                    new Noty({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> Successfully registered bank account!',
                        timeout: 4000
                    }).show();

                    $('#errorAgencyNumber').html('');
                    $('#agencia_numero').removeAttr("style");
                    $('#errorAccountNumber').html('');
                    $('#conta_numero').removeAttr("style");
                    $('#errorAccountDigit').html('');
                    $('#conta_digito').removeAttr("style");
                    $('#errorTitular').html('');
                    $('#titular').removeAttr("style");
                    $('#errorDocument').html('');
                    $('#documento').removeAttr("style");

                    $('#banco option:selected').val('');
                    $('#agencia_numero').val('');
                    $('#agencia_digito').val('');
                    $('#conta_numero').val('');
                    $('#conta_digito').val('');
                    $('#tipo_conta').val('');
                    $('#operacao').val('');
                    $('#titular').val('');
                    $('#documento').val('');

                }else{

                    new Noty({
                        type: 'error',
                        text: '<i class="fa fa-times"></i> Error registering bank account. Try again.',
                        timeout: 3000
                    }).show();

                }
            },

            complete: function(){

                $('#cadastrar_conta_bancaria').html('<i class="fa fa-plus"></i> Add Bank Account');
            },

            error: function(message){
                console.log('Error when registering bank account: ', message.responseText);
            }
        });
    });

    $(document).on('click', '#delete_bank', function(){

        let id_conta = $(this).attr('data-id');

        $.ajax({
            url: baseURL+'requests/delete_account_user',
            data: {id_conta: id_conta},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    new Noty({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> Bank Account successfully deleted!',
                        timeout: 4000
                    }).show();

                    $(document).find('tr[data-id="'+id_conta+'"]').css('background-color', '#ff6c60');
                    $(document).find('tr[data-id="'+id_conta+'"]').fadeOut(700);

                }else{

                    new Noty({
                        type: 'error',
                        text: '<i class="fa fa-times"></i> Error deleting bank account. Try again.',
                        timeout: 4000
                    }).show();
                }
            },

            error: function(message){
                console.log('Erro ao excluir conta: ', message.responseText);
            }
        });
    });

    $(document).on('keyup', '#carteira_bitcoin_input', function(){

        if($(this).val() == ''){
            $('#errorCarteiraBitcoin').html('Enter your Wallet address');
            $('#carteira_bitcoin_input').css('border', '1px solid #ff6c60');
        }else{
            $('#errorCarteiraBitcoin').html('');
            $('#carteira_bitcoin_input').css('border', '');
        }
    });

    $(document).on('click', '#cadastrar_carteira_bitcoin', function(){

        let carteira_bitcoin = $('#carteira_bitcoin_input').val();

        if(carteira_bitcoin == ''){

            $('#errorCarteiraBitcoin').html('Enter your Wallet address');
            $('#carteira_bitcoin_input').css('border', '1px solid #ff6c60');

            return false;
        }

        $.ajax({
            url: baseURL+'requests/add_carteira_bitcoin',
            data: {carteira_bitcoin:carteira_bitcoin},
            type: 'POST',
            dataType: 'json',

            beforeSend: function(){

                $('#cadastrar_carteira_bitcoin').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
            },

            success: function(callback){

                let html = '';

                if(callback.status == 1){

                    $('.close').click();

                    html += '<tr data-id="'+callback.id+'">';
                    html += '<td><input type="radio" name="carteira_bitcoin" id="carteira_bitcoin" value="'+callback.id+'" /></td>';
                    html += '<td>'+carteira_bitcoin+'</td>';
                    html += '<td>';
                    html += '<button type="button" class="btn btn-danger" id="delete_carteira" data-id="'+callback.id+'"><i class="fa fa-times"></i></button>';
                    html += '</td>';

                    $('#append_carteira').append(html);

                    new Noty({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> Successfully registered Ethereum wallet!',
                        timeout: 4000
                    }).show();

                    $('#errorCarteiraBitcoin').html('');
                    $('#carteira_bitcoin_input').removeAttr("style");
                    $('#carteira_bitcoin_input').val('');

                }else{

                    new Noty({
                        type: 'error',
                        text: '<i class="fa fa-times"></i> Error registering Ethereum wallet. Try again.',
                        timeout: 3000
                    }).show();

                }
            },

            complete: function(){

                $('#cadastrar_carteira_bitcoin').html('<i class="fa fa-plus"></i> Add Ethereum Wallet');
            },

            error: function(message){
                console.log('Error registering Ethereum wallet: ', message.responseText);
            }
        });
    });

    $(document).on('click', '#delete_carteira', function(){

        let id_carteira = $(this).attr('data-id');

        $.ajax({
            url: baseURL+'requests/delete_account_user',
            data: {id_conta: id_carteira},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    new Noty({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> Ethereum wallet successfully deleted!',
                        timeout: 4000
                    }).show();

                    $(document).find('tr[data-id="'+id_carteira+'"]').css('background-color', '#ff6c60');
                    $(document).find('tr[data-id="'+id_carteira+'"]').fadeOut(700);

                }else{

                    new Noty({
                        type: 'error',
                        text: '<i class="fa fa-times"></i> Error deleting Ethereum wallet. Try again.',
                        timeout: 4000
                    }).show();
                }
            },

            error: function(message){
                console.log('Error deleting Ethereum wallet: ', message.responseText);
            }
        });
    });

    $(document).on('click', '#solicitar_saque', function(){

        let valor_saque = $('#valor_saque').val();
        let tipo_saque = $('#tipo_saque:checked').val();
        let local_recebimento = $('#local_recebimento:checked').val();
		
		/*edward*/
		let timeSaque = $('#timeSaque').val();
		let timeText = $('#timeText').val();
		
        let id_conta = '';

        if(local_recebimento == 1){
            id_conta = $('#conta_bancaria:checked').val();
        }else{
            id_conta = $('#carteira_bitcoin:checked').val()
        }

        if(valor_saque <= 0){

            swal('Oppss...', 'Enter an amount greater than USD 0.00 to withdraw.', 'error');

            return false;
        }

        if(valor_saque == ''){

            swal('Oppss...', 'You need to enter the amount to be withdrawn.', 'error');

            return false;
        }

        $.ajax({
            url: baseURL+'requests/withdraw',
            data: {
				valor_saque: valor_saque, 
				tipo_saque: tipo_saque, 
				local_recebimento: local_recebimento, 
				
				timeSaque: timeSaque, 
				timeText: timeText, 
				
				id_conta: id_conta
			},
            type: 'POST',
            dataType: 'json',

            beforeSend: function(){

                $('#solicitar_saque').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
            },

            success: function(callback){

                if(callback.status == 1){

                    swal(
                         'Felicidades',
                         'Le enviamos un email de verificación para confirmar el retiro',
                         'success'
                         ).then(function(){
                            window.location.href=baseURL+'withdraw';
                         });

                }else if(callback.status == 2){

                    swal('Oppss...', 'But the withdrawal amount is higher than you take into account. Please check and try again. ', 'error');
                
                }else if(callback.status == 4){

                    swal('Erro!', 'The amount you are requesting is less than allowed. Please enter a higher value. ', 'error');

                
                }else if(callback.status == 5){

                    swal('Excuse me!', 'Not enabled to withdraw. ', 'error'); //DIEGO

                
                }                
                else{

                    swal('Desculpe', 'But there was an error in the withdrawal request (erro: '+callback.error+').', 'error');
                }
            },

            complete: function(){

                $('#solicitar_saque').html('<i class="fa fa-check"></i> Solicitar Saque');
            },

            error: function(message){
                console.log('Error when withdrawing: ', message.responseText); 
				
            }
			
			
        });
    });

}); /* ready */