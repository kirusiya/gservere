$(document).ready(function(){

  $("#aba_notificacoes").click(function(){

    $.ajax({

      url: baseURL+"requests/refresh_notification",
      dataType: 'json',

      success: function(callback){

        if(callback.status == 1){

          $("#quantidade_notificacoes_pendentes").fadeOut();
          $('#total_notificacoes_pendentes').html('0');
        }
      }
    });

  });

  $("#aba_notificacoes_admin").click(function(){

    $.ajax({

      url: baseURL+"requests/refresh_notification/1",
      dataType: 'json',

      success: function(callback){

        if(callback.status == 1){

          $("#quantidade_notificacoes_pendentes_admin").fadeOut();
          $('#total_notificacoes_pendentes_admin').html('0');
        }
      }
    });

  });

});