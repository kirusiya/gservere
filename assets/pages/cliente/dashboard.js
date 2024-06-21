$(document).ready(function(){

    /* Inicia o clipboard */
    let clipboard = new ClipboardJS('.clipboard');

    clipboard.on('success', function(){

        Swal.fire({
            text: "Referral link successfully copied!",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" }
        }).then(() => {
            Swal.close();
        });
    });


    $(document).on('click', '#chave', function(){

        let binary_key = $('#chave:checked').val();

        $.ajax({
            url: baseURL+'requests/change_binary_key',
            data: {key: binary_key},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    Swal.fire({
                        text: "Binary key successfully changed!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close();
                    });

                }else{
                    Swal.fire({
                        text: "Error changing binary key. Try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close();
                    });
                }
            },

            error: function(message){
                console.log('Error changing binary key: ', message.responseText);
            }
        });

    });

    if(typeof data_inicio != 'undefined'){
        
        $("#fim_plano")
          .countdown(data_inicio, function(event) {
            $(this).text(
              event.strftime('%D day(s) %H:%M:%S')
            );
        })
        .on('finish.countdown', function(){
            $('#fim_plano').html('EXPIRED PLAN!');
        }); //countdown
    }

}); /* end ready */