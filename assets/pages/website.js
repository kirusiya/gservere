$(document).ready(function(){

    $(document).on('click', '#EnviarFormulario', function(){

        let nome = $('#nome').val();
        let email = $('#email').val();
        let mensagem = $('#mensagem').val();

        if(nome == '' || email == '' || mensagem == ''){

            alert('Fill in all the form fields!');

            return;
        }

        $.ajax({
            url: baseURL+'requests/send_contact_form',
            type: 'POST',
            data: {nome:nome,email:email,mensagem:mensagem},

            success: function(){

                alert('Form sent successfully!');

                $('#nome').val('');
                $('#email').val('');
                $('#mensagem').val('');
            },

            error: function(message){

                alert('Error submitting contact form');

                console.log(message.responseText);
            }
        });
    });

});