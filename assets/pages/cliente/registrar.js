$(document).ready(function(){
    jQuery(function($){
      // $("#celular").mask("(99) 99999-999?9");
      // $("#cpf").mask("999.999.999-99");
    });

    $('#login').on('keypress', function(e) {
        var regex = new RegExp("^[0-9a-zA-Z\b]+$");
        var _this = this;

        setTimeout( function(){
            var texto = $(_this).val();
            if(!regex.test(texto)){             
                $(_this).val(texto.substring(0, texto.length-1));
            }
        }, 100);
    });
});