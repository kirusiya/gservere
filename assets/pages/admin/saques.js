$(document).ready(function(){
    
    if($('.responsive-data-table')[0]){

        $('.responsive-data-table').DataTable({
            "PaginationType": "bootstrap",
            "ordering": false,
            responsive: true,
            dom: 'Bfrtip, <"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
			buttons: [
				'excel', 'pdf', 'print'
			],
            "language": {
                "lengthMenu": "Showing _MENU_ records per page",
                "zeroRecords": "Sorry, nothing found.",
                "info": "Showing _PAGE_ from _PAGES_",
                "infoEmpty": "no records found",
                "infoFiltered": "(filtered from _MAX_ records)",
                "search": "Search:",
                "loadingRecords": "Loading...",
                "processing": "Nrocessing...",
                "emptyTable": "No records to display on this page",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Next",
                    "previous":   "Previous"
                },
                "aria": {
                    "sortAscending":  ": Enabled to sort columns ascending",
                    "sortDescending": ": Enabled to sort columns descending"
                }
            }
        });

    }

    $(document).on('click', '#MarcarComoPago', function(){

        let id_saque = $(this).attr('value');

        $.ajax({
            url: baseURL+'requests/pay_withdraw',
            data: {id_saque: id_saque},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    swal(
                         'Congratulations!',
                          'Withdrawal has been marked as successfully paid!',
                          'success'
                         ).then(function(){
                            window.location.href=baseURL+'admin/saques/visualizar/'+id_saque
                         });
                }else{
                    swal('Oppss...', 'Sorry, but the withdrawal could not be reversed. Check if the withdrawal exists.', 'error');
                }
            },

            error: function(message){
                console.log('Error marking withdrawal as paid: ', message.responseText);
            }
        });
    });

    $(document).on('click', '#Estornar', function(){

        let id_saque = $(this).attr('value');

        $.ajax({
            url: baseURL+'requests/reverse_withdraw',
            data: {id_saque: id_saque},
            type: 'POST',
            dataType: 'json',

            success: function(callback){

                if(callback.status == 1){

                    swal(
                         'Congratulations!',
                          'The withdrawal was successfully reversed to the user!',
                          'success'
                         ).then(function(){
                            window.location.href=baseURL+'admin/saques/visualizar/'+id_saque
                         });
                }else{
                    swal('Oppss...', 'Sorry, but the withdrawal could not be reversed. Check if the withdrawal exists.', 'error');
                }
            },

            error: function(message){
                console.log('Error reversing withdrawal: ', message.responseText);
            }
        });
    });

}); /* ready */