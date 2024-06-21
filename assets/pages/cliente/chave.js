$(document).ready(function(){

    $(document).on('click', '#chave_binaria', function(){

        $('input#chave_binaria').prop('checked', false);

        // Marcar solo el checkbox en el que se hizo clic
        $(this).prop('checked', true);

        let binary_key = $('#chave_binaria:checked').val();

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
    
}); /* ready */