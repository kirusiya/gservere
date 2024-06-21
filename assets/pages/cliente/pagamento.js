$(document).ready(function(){

    $(document).on('click', '#searchInvoice', function(){

        let id_fatura = $('#id_fatura').val().trim();

        if(id_fatura != ''){

            $.ajax({
                url: baseURL+'requests/search_invoice',
                data: {id_fatura: id_fatura},
                type: 'POST',
                dataType: 'json',

                beforeSend: function(){
                    $('#searchInvoice').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                    $('#bloco_confirmacao').css('display', 'none');
                },

                success: function(callback){

                    if(callback.status == 1){
                        $('#valor_fatura').html(callback.valor_fatura);
                        $('#id_pay').val(id_fatura);

                        $('#bloco_confirmacao').css('display', 'block');

                    }else if(callback.status == 2){
                        swal('Sorry', 'But the invoice you are looking for has already been paid.', 'error');
                    }else{
                        swal('Oppps...', 'Sorry, but it was not possible to locate the invoice indicated. Please check and try again', 'error');
                    }
                },

                complete: function(){
                    $('#searchInvoice').html('<i class="fa fa-search"></i> Buscar Fatura');
                },

                error: function(message){
                    console.log('Erro ao procurar fatura: ', message.responseText);
                }
            });
        }
    });

    $(document).on('click', '#finalizar_pagamento', function(){

        swal({
          title: 'Você tem certeza?',
          html: "To confirm the payment, select the option below and click on the <b>Confirm</b> button",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm',
          cancelButtonText: 'Cancel',
          input: 'checkbox',
          inputValue: 1,
          inputPlaceholder:
            '&nbsp; I am aware that this action is irreversible',
          inputOptions: {checked: 'unchecked'},
          onOpen: function(){
            $('#swal2-checkbox').removeAttr('checked');
          },
          inputValidator: function (result) {
            return new Promise(function (resolve, reject) {
              if (result) {
                resolve()
              } else {
                reject('You need to select the option above')
              }
            })
          }
        }).then(function () {

        let id_fatura = $('#id_pay').val();
        let forma_pagamento = $('#forma_pagamento:checked').val();
          
          $.ajax({
            url: baseURL+'requests/invoce_pay',
            data: {id_fatura: id_fatura, forma_pagamento: forma_pagamento},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    swal(
                         'Congratulations',
                         'The invoice has been successfully paid!',
                         'success'
                         ).then(function(){
                            window.location.href=baseURL+'pagamento';
                         });

                }else if(callback.status == 2){

                    swal('Oppss...', 'The invoice you are trying to pay has already been paid.', 'error');

                }else if(callback.status == 3){

                    swal('Oppss...', 'The invoice you are trying to pay does not exist', 'error');

                }else{

                    swal('Desculpe', 'But you dont have enough balance to pay that bill.', 'error');
                }
            },

            error: function(message){
                console.log('Error when paying invoice: ', message.responseText);
            }
          });

        })

    });

}); /* ready */