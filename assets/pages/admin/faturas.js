$(document).ready(function(){

    if($('.responsive-data-table')[0]){

        $('.responsive-data-table').DataTable({
            "PaginationType": "bootstrap",
            "ordering": false,
            "aLengthMenu": [[10, 15, 30, -1], [10, 30, 100, "Todos"]], //DIEGO
            responsive: true,
            dom: '<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
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

        if($('.tableExtrato')[0]){
            $('.tableExtrato').css('width', '100%');
        }
    }

    jQuery(function($){
       $("#celular").mask("(99) 99999-999?9");
       $("#cpf").mask("999.999.999-99");
    });
 
}); /* ready */