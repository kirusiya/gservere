$(document).ready(function(){

    $('#inicio, #termino').each(function(){
        $(this).mask("99:99");
    });

    $(document).on('change', 'input[name="smtp"]', function(){

        let smtp = $('input[name="smtp"]:checked').val();

        if(smtp == 1){
            $('#configuracoes_smtp').css('display', 'block');
        }else{
            $('#configuracoes_smtp').css('display', 'none');
        }
    });

    $(document).on('click', '#ExcluirBloco', function(){
        $(this).closest('tr').css('background-color', 'red');
        $(this).closest('tr').fadeOut(700, function(){
            $(this).remove();
        });
    });

    $(document).on('click', '#addHorario', function(){

        let html  = '<tr>';
            html += '<td>';
            html += '<select name="dias[]" class="form-control">';
            html += '<option value="0">Domingo</option>';
            html += '<option value="1">Segunda-Feira</option>';
            html += '<option value="2">Terça-Feira</option>';
            html += '<option value="3">Quarta-Feira</option>';
            html += '<option value="4">Quinta-Feira</option>';
            html += '<option value="5">Sexta-Feira</option>';
            html += '<option value="6">Sábado</option>';
            html += '</select>';
            html += '</td>';
            html += '<td><input type="text" id="inicio" name="inicio[]" class="form-control"></td>';
            html += '<td><input type="text" id="termino" name="termino[]" class="form-control"></td>';
            html += '<td><button type="button" id="ExcluirBloco" class="btn btn-danger"><i class="fa fa-times"></i> Excluir</button></td>';
            html += '</tr>';

        $('#tabelaPagamentos > tbody').append(html);

        $('#inicio, #termino').each(function(){
            $(this).mask("99:99");
        });
    });

}); /* ready */